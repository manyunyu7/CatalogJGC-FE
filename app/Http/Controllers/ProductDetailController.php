<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Product;

class ProductDetailController extends Controller
{
    public function show($parentId, $id)
    {
        $apiUrl = "https://api-web.jakartagardencity.com/product/$parentId";

        try {
            // Panggil API dari backend CMS
            $client = new Client();
            $response = $client->get($apiUrl);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                // Ambil data produk dari API
                $responseBody = json_decode($response->getBody(), true);
                $product = json_decode(json_encode($responseBody['data']));

                // Tampilkan data ke tampilan frontend
                $baseImageUrl = "https://api-web.jakartagardencity.com";
                return view('catalog.detail', compact('product', 'baseImageUrl'));
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
