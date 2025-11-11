<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // ...
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('feedback-store', function (Request $request) {
            // Kunci identitas: email (jika diisi) atau IP (fallback)
            $identity = strtolower((string) $request->input('email'));
            $key = 'feedback:' . ($identity !== '' ? $identity : $request->ip());

            return Limit::perMinutes(360, 1)  // 360 menit = 6 jam, 1 percobaan
                ->by($key)
                ->response(function () {
                    // Respon saat limit terlampaui
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Batas pengiriman tercapai. Anda hanya bisa mengirim 1 feedback setiap 6 jam.');
                });
        });
    }
}
