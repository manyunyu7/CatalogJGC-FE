<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MyMainProfileController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated');
        }

        $response = Http::withToken($token)
            ->get(env('URL_BE') . 'products');


        if ($response->successful()) {
            $products = collect($response->json()['result'])->map(function ($product) {
                return (object) $product; // Convert each user array to an object
            });

            $compact = compact('products');
            return view('catalog.index')->with($compact);
        }

        return back()->with('error', 'Failed to fetch users');
    }
}
