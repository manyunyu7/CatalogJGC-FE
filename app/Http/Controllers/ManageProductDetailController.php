<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ManageProductDetailController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('URL_BE') . 'cms-user/manage-product-details';
    }

    public function index(Request $request, $parent_id)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/{$parent_id}");

        if ($response->successful()) {
            $productDetails = $response->json()['result'];
            return view('manage_product_details.index', compact('productDetails', 'parent_id'));
        }

        Log::error('Failed to fetch product details', [
            'status' => $response->status(),
            'response_body' => $response->body()
        ]);

        return back()->with('error', 'Failed to fetch product details');
    }

    public function storeOrUpdate(Request $request, $parent_id)
    {
        $token = $request->cookie('killaToken');
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }


        try {
            $response = Http::withToken($token)->post("{$this->apiBaseUrl}/{$parent_id}", $request->all());
            $responseData = $response->json();

            if ($response->successful() && isset($responseData['meta']['message'])) {
                return back()->with('success', $responseData['meta']['message']);
            }

            // Check if 'result.validation_errors' exists
            if (isset($responseData['result']['validation_errors'])) {
                // Flatten the validation errors and join them into a string
                $errorMessages = collect($responseData['result']['validation_errors'])->flatten()->implode(', ');
                return back()->with('error', $errorMessages)->withInput();
            }

            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to save product detail')->withInput();
        } catch (RequestException $e) {
            Log::error('Error during API request', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Error during API request')->withInput();
        }
    }


    public function destroy(Request $request, $parent_id)
    {
        $token = $request->cookie('killaToken');

        try {
            $response = Http::withToken($token)->delete("{$this->apiBaseUrl}/{$parent_id}");

            if ($response->successful()) {
                return back()->with('success', 'Product Detail deleted successfully');
            }

            return back()->with('error', 'Failed to delete product detail');
        } catch (RequestException $e) {
            Log::error('Error during API request', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Error during API request');
        }
    }
}
