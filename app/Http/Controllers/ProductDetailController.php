<?php

namespace App\Http\Controllers;

use App\Helper\Killa;
use App\Helper\SafeObjectHelper;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;
use stdClass;

class ProductDetailController extends Controller
{
    public function show(Request $request, $clusterSlug, $titleSlug)
    {
        $baseUrlImage = "https://api-web.jakartagardencity.com";

        // Cache key for products list
        $cacheKey = 'products_list';

        // Fetch products with caching (set for 24 hours)
        $result = Cache::remember($cacheKey, 1440, function () {
            $response = Http::get(env('URL_BE') . 'products');
            return $response->successful() ? $response->json()['result'] : [];
        });

        $propertyType = "";

        // Find the product based on clusterSlug and titleSlug
        $item = collect($result)->first(function ($item) use ($clusterSlug, $titleSlug) {
            return $item['cluster_slug'] === $clusterSlug && $item['full_slug'] === "$clusterSlug/$titleSlug";
        });

        if ($item) {
            $parentId = $item['parent_id'];
            $childId = $item['id'];
            $parentName = $item['parent_name'];

            // Construct product detail URL
            $url = env('URL_BE') . "product/detail/{$parentId}/{$childId}";

            // Retrieve authentication token from cookies
            $token = $request->cookie('killaToken');

            // Fetch detailed product information
            $detailResponse = Http::withToken($token)->get($url);


            if ($detailResponse->successful()) {
                $detailResult = $detailResponse->json()['result'];
                $data = new SafeObjectHelper($detailResult);

                $product = $data->product;
                $productInformationDetail = $data->productInformationDetail;
                $facilitiesTransaction = $data->facilities_transaction ?? [];

                $propertyType = isset($product->type) ? $this->getProductPropertyType($product->type) : 'Unknown';
                $product->propertyTypeName = $propertyType;

                $typeDetail = null;
                if (!empty($product->types)) {
                    foreach ($product->types as $type) {
                        if (!empty($type->categories)) {
                            foreach ($type->categories as $category) {
                                if ($category->id === $childId) {
                                    $typeDetail = (object) $category;
                                    break 2;
                                }
                            }
                        }
                        if (!$typeDetail) {
                            $typeDetail = $type;
                        }
                    }
                }

                $product->parent_id = $parentId;
                $product->child_id = $childId;
                $product->parent_name = $parentName;

                $typeDetail->electricity = $productInformationDetail->electricity ?? 0;
                $typeDetail->floor = $productInformationDetail->floor ?? 0;
                $typeDetail->cluster_icon_path = $baseUrlImage . $product->logo_colorize . "?w=1920&q=75";

                $imagesResponse = Http::get(env('URL_BE') . "cms-user/product-images?parent_id={$childId}");

                $productImages = [];
                if ($imagesResponse->successful()) {
                    try {
                        $productImagesFromLocal = $imagesResponse->json()['result'];
                        foreach ($productImagesFromLocal as $key1) {
                            $prd = new stdClass();
                            $prd->full_img_path = $key1['full_image_path'];
                            $prd->type = $key1['type'];
                            $prd->from = "local";
                            array_push($productImages, $prd);
                        }
                    } catch (\Exception $e) {
                        // Handle image fetching errors
                    }
                }

                foreach ($product->images as $key2) {
                    try {
                        $prd = new stdClass();
                        $prd->full_img_path = $baseUrlImage . $key2->image;
                        $prd->type = "Cluster";
                        $prd->from = "jgc";
                        array_push($productImages, $prd);
                    } catch (\Exception $e) {
                        // Handle image processing errors
                    }
                }

                $compact = compact('productInformationDetail', 'product', 'typeDetail', 'facilitiesTransaction', 'productImages');

                if ($request->dump == true) {
                    return $compact;
                }

                return view('catalog.detail', $compact);
            }

            Log::error('Failed to fetch product details', [
                'status' => $detailResponse->status(),
                'response_body' => $detailResponse->body(),
            ]);

            return back()->with('error', 'Failed to fetch product details');
        }

        return redirect()->back()->with('error', 'No matching product found');
    }

    public function getDetailInformation(Request $request){
        $response = new stdClass();
        $response->information = 0;

        $productInfo = ProductDetail::where(
            "parent_id",'=',$request->id
        )->first();

        if($productInfo != null){
            $response->information = $productInfo;
            $response->floor = $productInfo->floor ?? 0;
        }

        return Killa::responseSuccessWithMetaAndResult(200, 1, 'Success', $response);
    }


    private function getProductPropertyType($type)
    {
        $types = [
            0 => 'Perumahan',
            1 => 'Apartemen',
            2 => 'Komersil'
        ];

        return $types[$type] ?? 'Unknown';
    }
}
