<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Your logic to check the installer flag
        if (config('app.installer_flag')) {
            // Installer flag is true, proceed with the request
            return $next($request);
        } else {
            return $next($request);
            // Installer flag is not set, redirect or handle accordingly
            return redirect()->route('installer.index');
        }
    }
}
