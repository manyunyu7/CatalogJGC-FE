<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Models\Promo;

class MyMainProfileController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the products from the API
        $response = Http::get(env('URL_BE') . 'products');


        // Handle errors in the API request and return a detailed error message
        if (!$response->successful()) {
            abort(400, 'Failed to fetch products: ' . json_encode($response->json()));  // HTTP status 400 with detailed message
        }

        // Process the response and map products
        $products = collect($response->json()['result'])->map(function ($product) {
            return (object) $product;  // Convert each product array to an object
        });

        $bannerResponse = Http::get('http://127.0.0.1:6167/api/banners');  // Sesuaikan URL API banner
        if (!$bannerResponse->successful()) {
            abort(400, 'Failed to fetch banners: ' . json_encode($bannerResponse->json()));  // Handle error
        }
        $banners = $bannerResponse->json()['banners'];


        return view('catalog.index', compact('products','banners'));
    }
    public function showDetail($id)
    {
        // Fetch product detail from API
        $response = Http::get("https://api-web.jakartagardencity.com/product/{$id}");
        $product = $response->object()->data ?? null;
    
        if (!$product) {
            abort(404); // Produk tidak ditemukan
        }
    
        return view('catalog.detail', compact('product'));
    }
    
}
