<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class ProductImageController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('URL_BE'),
        ]);
    }

    public function manageImages(Request $request, $parentId)
    {
        $token = $request->cookie('killaToken');

        if (!$token) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'status' => 401,
                    'message' => 'User is not authenticated',
                ],
                'result' => [],
            ], 401);
        }

        // Fetch existing images
        $response = $this->client->get("cms-user/product-images?parent_id={$parentId}", [
            'headers' => [
                'Authorization' => "Bearer {$token}",
            ],
        ]);

        $images = json_decode($response->getBody(), true)['result'] ?? [];

        return response()->json([
            'meta' => [
                'success' => true,
                'status' => 200,
                'message' => 'Images retrieved successfully.',
            ],
            'result' => $images,
        ], 200);
    }

    public function uploadImages(Request $request, $parentId)
    {

        $token = $request->cookie('killaToken');

        if (!$token) {
            return response()->json(['message' => 'User is not authenticated'], 401);
        }

        try {
            $multipartData = [];

            // Add images
            foreach ($request->file('images') as $image) {
                $multipartData[] = [
                    'name'     => 'images[]',
                    'contents' => fopen($image->getRealPath(), 'r'),
                    'filename' => $image->getClientOriginalName(),
                ];
            }

            // Add type
            if ($request->has('type')) {
                $multipartData[] = [
                    'name'     => 'type',
                    'contents' => $request->input('type'),
                ];
            }

            // Add description
            if ($request->has('description')) {
                $multipartData[] = [
                    'name'     => 'description',
                    'contents' => $request->input('description'),
                ];
            }

            $response = $this->client->post("cms-user/product-images/{$parentId}", [
                'headers' => ['Authorization' => "Bearer {$token}"],
                'multipart' => $multipartData
            ]);

            return response()->json(['message' => 'Images uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error uploading images: ' . $e->getMessage()], 500);
        }
    }

    public function deleteImage(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        if (!$token) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        try {
            $response = $this->client->delete("cms-user/product-images/$id", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
            ]);

            return response()->json(['success' => 'Image deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting image: ' . $e->getMessage()], 500);
        }
    }


    public function reorderImages(Request $request)
    {
        $token = $request->cookie('killaToken');

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'User is not authenticated',
            ], 401);
        }

        try {
            $response = $this->client->post("product-images/reorder", [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'images' => $request->input('images'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Images reordered successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error reordering images: ' . $e->getMessage(),
            ], 500);
        }
    }
}
