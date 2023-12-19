<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Cek apakah rute "login" telah didefinisikan
        if (!Route::has('login')) {
            // Jika tidak didefinisikan, arahkan pengguna ke halaman utama
            return '/';
        }

        return $request->expectsJson() ? null : route('login');
    }
}
