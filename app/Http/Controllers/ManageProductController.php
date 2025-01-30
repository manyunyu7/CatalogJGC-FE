<?php

namespace App\Http\Controllers;


use App\Helper\SafeDataObject;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class ManageProductController extends Controller
{

    public function viewEdit(Request $request, $clusterId, $id)
    {

        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Get user and address data from the backend API
        $response = Http::withToken($token)->get(env('URL_BE') . "product/detail/{$clusterId}/{$id}");


        if ($response->successful()) {
            $data = (object) $response->json()['result']; // Make sure this is an object
            $typeDetail = null; // Initialize as null (no match found yet)

            foreach ($data->types as $type) {
                foreach ($type['categories'] as $category) {
                    if ($category['id'] === $id) {
                        $typeDetail =  (object) $category; // Assign the matching category
                        break 2; // Exit both loops once a match is found
                    }
                }
            }

            $data->price = (object) $data->price;

            $data->type_detail = $typeDetail;
            $data->parent_id = $clusterId;
            $data->child_id = $id;

            $compact = compact('data');
            if ($request->dump == true) {
                return $compact;
            }

            // Wrap the data in optional() so it can handle missing properties safely
            $data = optional($data);
            $compact = compact('data');



            return view('manage_product.edit', $compact);
        }

        // Log the error details for debugging
        Log::error('Failed to fetch user data', [
            'status' => $response->status(),
            'response_body' => $response->body(),
            'error_message' => $response->json() // or $response->throw() if you want to force an exception
        ]);

        return back()->with('error', 'Failed to fetch user data');
    }

    public function viewManage(Request $request)
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

            if ($request->dump == true) {
                return $compact;
            }


            return view('manage_product.manage', compact('products'));
        }
    }
}
