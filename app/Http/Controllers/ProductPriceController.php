<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductPriceController extends Controller
{
    public function updatePriceFe(Request $request)
    {

        // Retrieve the token from session
        $token = $request->cookie('killaToken');


        $parentId = $request->parent_id;
        $response = Http::withToken($token)->post(env('URL_BE') . "cms-product/{$parentId}/update-price", [
            'parent_id' => $request->parent_id,
            'prefix' => $request->price_prefix,
            'price' => $request->price,
        ]);


        if ($response->successful()) {
            return back()->with('success', 'Price saved successfully');
        }

        return back()->with('error', 'Failed to update price');
    }
}
