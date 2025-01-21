<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KillaAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the token from the session
        $token = session('token');

        // Check if the token exists
        if (!$token) {
            // Token is not available, redirect to login
            return redirect()->route('login');  // Adjust this to your login route
        }

        // Make the request to the /user-info endpoint with the token in the Authorization header
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('URL_BE') . 'cms-auth/user');

        // Check if the response contains valid user data
        $data = $response->json();
        if (isset($data['meta']['success']) && $data['meta']['success'] && $data['result'] !== null) {
            // User is logged in, proceed
            return $next($request);
        }

        // User is not logged in, redirect to login
        return redirect()->route('login');  // Adjust this to your login route
    }
}
