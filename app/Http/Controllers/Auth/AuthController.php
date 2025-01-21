<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Get the backend URL from env
        $url = env('URL_BE') . 'cms-auth/login';

        // Send login request to backend
        $response = Http::post($url, [
            'email' => $request->email,
            'password' => $request->password,
        ]);


        // Handle response
        if ($response->successful()) {
            // Store token (for example, in session or localStorage)
            session(['token' => $response->json()['result']['token']]);

            return redirect()->to('/home');
        } else {
            // Show error message
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }


}
