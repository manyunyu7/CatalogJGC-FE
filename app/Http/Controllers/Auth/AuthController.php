<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    public function loginView(Request $request)
    {

        $token = session('killaToken');
        // Make the request to the /user-info endpoint with the token in the Authorization header
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('URL_BE') . 'cms-auth/user');

        // Check if the response contains valid user data
        $data = $response->json();
        if (isset($data['meta']['success']) && $data['meta']['success'] && $data['result'] !== null) {
            return redirect()->to('/home');
        } else {
            return view('auth.login');
        }
    }

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
            $token = $response->json()['result']['token'];
            $expiresAt = now()->addWeek(4); //expire in 4 week

            // Store token in cookie (expires in 30 days)
            Cookie::queue('killaToken', $token, 60 * 24 * 30);


            return redirect()->to('/home');
        } else {
            // Show error message
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
}
