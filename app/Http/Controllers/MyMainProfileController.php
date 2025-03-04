<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Laravel\Ui\Presets\React;

class MyMainProfileController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the products from the API
        $response = Http::get(env('URL_BE') . 'products');


        $responseSlider = Http::get(env('URL_BE') . 'slider/all');



        // Handle errors in the API request and return a detailed error message
        if (!$response->successful()) {
            abort(400, 'Failed to fetch products: ' . json_encode($response->json()));  // HTTP status 400 with detailed message
        }

        // Process the response and map products
        $products = collect($response->json()['result'])->map(function ($product) {
            return (object) $product;  // Convert each product array to an object
        });

        $sliders = collect($responseSlider->json()['result'])->map(function ($slider) {
            return (object) $slider;  // Convert each product array to an object
        });


        $compact = compact('products', 'sliders');

        if($request->dump==true) {
            return response()->json($compact);
        }

        return view('catalog.index', $compact);
    }
}
