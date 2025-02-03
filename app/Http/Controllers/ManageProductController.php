<?php

namespace App\Http\Controllers;


use App\Helper\SafeObjectHelper;
use App\Models\ProductPrice;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class ManageProductController extends Controller
{

    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('URL_BE') . 'fasilitas-transactions';
    }

    public function viewEdit(Request $request, $clusterId, $id)
    {

        // Retrieve the token from session
        $token = $request->cookie('killaToken');


        $url = env('URL_BE') . "product/detail/{$clusterId}/{$id}";

        // Get user and address data from the backend API
        $response = Http::withToken($token)->get($url);


        if ($response->successful()) {
            $result = $response->json()['result'];
            $data = new SafeObjectHelper($result); // Convert everything to SafeObject
            $typeDetail = null; // Initialize as null (no match found yet)


            $product = $data->product;
            foreach ($product->types as $type) {
                foreach ($type->categories as $category) {
                    if ($category->id === $id) {
                        $typeDetail =  (object) $category; // Assign the matching category
                        break 2; // Exit both loops once a match is found
                    }
                }
            }


            $product->type_detail = $typeDetail;
            $product->parent_id = $clusterId;
            $product->child_id = $id;

            $facilities = $data->facilities;
            $facilitiesTransaction = $data->facilities_transaction;


            // Wrap the data in optional() so it can handle missing properties safely
            $product = optional($product);
            $compact = compact('product', 'facilities','facilitiesTransaction');

            if ($request->dump == true) {
                return $compact;
            }


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

    public function updateFacility(Request $request)
    {

        $token = $request->cookie('killaToken');
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        $validatedData = $request->validate([
            'parent_id' => 'nullable',
            'unit_facilities' => 'required|array',
            'unit_facilities.*' => 'required|exists:fasilitas,id',
        ]);

        $apiUrl = env('URL_BE') . 'fasilitas-transactions/bulk-update';
        $client = new Client();

        $multipartData = [];
        foreach ($validatedData as $key => $value) {
            if ($key === 'unit_facilities') {
                foreach ($value as $facility) {
                    $multipartData[] = [
                        'name' => 'unit_facilities[]',
                        'contents' => $facility,
                    ];
                }
            } else {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        try {

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
                'multipart' => $multipartData,
            ]);


            $responseData = json_decode($response->getBody(), true);


            if (!$responseData['meta']['success']) {
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to update facilities.')->withInput();
            }

            return back()->with('success', $responseData['meta']['message'] ?? 'Facilities updated successfully')->withInput($validatedData);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            $errorMessage = $responseBody['meta']['message'] ?? $e->getMessage();
            return back()->with('error', 'Error during API request: ' . $errorMessage)->withInput();
        }
    }
}
