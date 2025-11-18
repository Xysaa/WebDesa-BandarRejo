<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Durasi lockout (menit) per tahap.
     * 1x blok 3 kali salah = 1 menit,
     * 2x blok = 3 menit,
     * dst...
     */
    protected array $lockoutMinutes = [1, 3, 5, 10, 15, 30, 60, 1440]; // 1440 = 24 jam

    public function showLoginForm()
    {
        if (Auth::check()) {
            // SUDAH LOGIN → ARAHKAN SESUAI ROLE
            return $this->redirectByRole(Auth::user());
        }

        // sesuaikan dengan nama view login kamu
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Cek apakah sedang dikunci (lockout)
        $throttleData = $this->getThrottleData($request);

        if (!empty($throttleData['locked_until'])) {
            $lockedUntil = Carbon::parse($throttleData['locked_until']);

            if (now()->lt($lockedUntil)) {
                $seconds = now()->diffInSeconds($lockedUntil);

                return back()
                    ->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $this->formatSeconds($seconds) . '.')
                    ->withInput($request->only('email'));
            }
        }

        // 3. Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // login berhasil
            $request->session()->regenerate();
            $this->clearThrottleData($request);

            $user = Auth::user();

            // 🚀 REDIRECT SESUAI ROLE, BUKAN LANGSUNG KE /dashboard
            return $this->redirectByRole($user);
        }

        // 4. Jika login gagal -> tambah percobaan dan hitung lockout
        $throttleData['attempts'] = ($throttleData['attempts'] ?? 0) + 1;

        // setiap 3x gagal, naik stage dan set lockout
        if ($throttleData['attempts'] % 3 === 0) {
            $currentStage = $throttleData['stage'] ?? 0;

            if ($currentStage < count($this->lockoutMinutes)) {
                $currentStage++;
            }

            $throttleData['stage'] = $currentStage;

            // ambil durasi lockout sesuai stage
            $minutes = $this->lockoutMinutes[$currentStage - 1] ?? end($this->lockoutMinutes);

            $throttleData['locked_until'] = now()->addMinutes($minutes);
        }

        $this->saveThrottleData($request, $throttleData);

        return back()
            ->with('error', 'Email atau password salah.')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // bebas mau ke login atau ke home, pilih salah satu
        return redirect()->route('login');
        // return redirect()->route('home');
    }

    /*
    |--------------------------------------------------------------------------
    | Redirect sesuai role
    |--------------------------------------------------------------------------
    */
    private function redirectByRole($user)
    {
        // pastikan value role di DB: 'admin' atau 'kepala_dusun'
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.index');
        }

        if ($user->role === 'kepala_dusun') {
            // route('dashboard.penduduk') => /dashboard/penduduk
            return redirect()->route('dashboard.penduduk');
        }

        // fallback kalau suatu saat ada role lain
        return redirect()->route('home');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Throttle
    |--------------------------------------------------------------------------
    */

    protected function throttleKey(Request $request): string
    {
        // Bisa pakai kombinasi IP + email
        return 'login_attempts:' . sha1($request->ip() . '|' . $request->input('email'));
    }

    protected function getThrottleData(Request $request): array
    {
        return Cache::get($this->throttleKey($request), [
            'attempts'     => 0,
            'stage'        => 0,
            'locked_until' => null,
        ]);
    }

    protected function saveThrottleData(Request $request, array $data): void
    {
        // Simpan data attempts max 2 hari
        Cache::put($this->throttleKey($request), $data, now()->addDays(2));
    }

    protected function clearThrottleData(Request $request): void
    {
        Cache::forget($this->throttleKey($request));
    }

    /**
     * Format detik jadi string yang enak dibaca (misal: "59 detik", "2 menit", "1 jam 5 menit").
     */
    protected function formatSeconds(int $seconds): string
    {
        if ($seconds < 60) {
            return $seconds . ' detik';
        }

        $minutes = intdiv($seconds, 60);
        $sec     = $seconds % 60;

        if ($minutes < 60) {
            return $minutes . ' menit' . ($sec > 0 ? ' ' . $sec . ' detik' : '');
        }

        $hours   = intdiv($minutes, 60);
        $minutes = $minutes % 60;

        return $hours . ' jam' . ($minutes > 0 ? ' ' . $minutes . ' menit' : '');
    }
}
