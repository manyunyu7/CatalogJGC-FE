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
        $token = cookie('killaToken');

        // Check if the token exists
        if ($token) {
            // Make the request to the /user-info endpoint with the token in the Authorization header
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('URL_BE') . 'cms-auth/user');

            // Check if the response contains valid user data
            $data = $response->json();
            if (isset($data['meta']['success']) && $data['meta']['success'] && $data['result'] !== null) {
                // User is logged in
                if ($request->routeIs('login')) {
                    // If the current route is /login, redirect to the dashboard or another page
                    return redirect()->route('dashboard'); // Adjust this to your desired route
                }

                // Proceed with the request
                return $next($request);
            }
        }

        // User is not logged in, allow access to the /login route or other routes
        return $next($request);
    }
}
