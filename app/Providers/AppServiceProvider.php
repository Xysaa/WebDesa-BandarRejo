<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * Limiter: feedback-store
         * Prioritas identitas:
         *   1) user_id (kalau login)
         *   2) email (jika diisi di form)
         *   3) IP address (fallback)
         */
        RateLimiter::for('feedback-store', function (Request $request) {
            $userId = optional($request->user())->getAuthIdentifier();
            $email  = strtolower((string) $request->input('email'));

            $key = $userId
                ? "feedback:user:{$userId}"
                : ($email !== ''
                    ? "feedback:email:{$email}"
                    : "feedback:ip:".$request->ip());

            // 1 permintaan per 360 menit (6 jam)
            return Limit::perMinutes(360, 1)->by($key)
                ->response(function () {
                    return back()
                        ->withInput()
                        ->with('error', 'Batas pengiriman tercapai. Anda hanya bisa kirim 1 feedback setiap 6 jam.');
                });
        });
    }
}
