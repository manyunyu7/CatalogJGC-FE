<?php

namespace App\Http\Controllers;

use App\Models\MySlider;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MyProfileSliderController extends Controller
{
    public function manageSlider(Request $request)
    {

        // Retrieve the token from cookie
        $token = $request->cookie('killaToken');


        // Ensure the token is available
        if ($token == "" || $token == null) {
            return back()->with('error', 'User is not authenticated');
        }

        // API endpoint
        $apiUrl = env('URL_BE') . 'slider/manage';

        // Make the API request with the token
        $response = Http::withToken($token)->get($apiUrl);

        // Check if the API request was successful
        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch sliders. Please try again later.');
        }

        // Parse the response data
        $responseData = $response->json();

        // Ensure the API response indicates success
        if (!isset($responseData['meta']['success']) || !$responseData['meta']['success']) {
            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to fetch sliders.');
        }

        // Extract the slider data from the response and convert to object
        $datas = collect($responseData['result'] ?? [])->map(function ($item) {
            return (object) $item;
        });

        // Pass the data to the view
        return view('slider.manage', compact('datas'));
    }

    public function viewEdit(Request $request, $id)
    {
        // Retrieve the token from session
        // Retrieve the token from cookie
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated');
        }

        // API endpoint for fetching slider data
        $apiUrl = env('URL_BE') . "slider/edit/{$id}";

        // Make the API request with the token
        $response = Http::withToken($token)->get($apiUrl);

        // Check if the API request was successful
        if ($response->failed()) {
            return back()->with('error', 'Failed to fetch slider data. Please try again later.');
        }

        // Parse the response data
        $responseData = $response->json();

        // Ensure the API response indicates success
        if (!isset($responseData['meta']['success']) || !$responseData['meta']['success']) {
            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to fetch slider data.');
        }

        // Extract the slider data from the response and convert to an object
        $data = isset($responseData['result']) ? (object) $responseData['result'] : null;

        // Check if data is available
        if (!$data) {
            return back()->with('error', 'Slider data not found.');
        }

        // Pass the data to the view
        return view('slider.edit', compact('data'));
    }


    public function update(Request $request)
    {

        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Prepare the data for the API
        $data = $request->only([
            'title',
            'id',
            'description',
            'action',
            'action_link',
            'second_action',
            'second_action_link',
            'order',
        ]);

        // Prepare the multipart data for Guzzle
        $multipartData = [];

        // Add form fields
        foreach ($data as $key => $value) {
            $multipartData[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        // Add files if present
        $files = ['image', 'icon']; // List of possible files
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $multipartData[] = [
                    'name' => $file,
                    'contents' => fopen($request->file($file)->getRealPath(), 'r'),
                    'filename' => $request->file($file)->getClientOriginalName(),
                ];
            }
        }

        // API endpoint for updating data
        $apiUrl = env('URL_BE') . 'slider/update'; // Adjust your API URL accordingly

        // Create the Guzzle client
        $client = new Client();

        try {
            // Make the POST request with Guzzle
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
                'multipart' => $multipartData, // Correctly formatted multipart data
            ]);

            // Decode the response
            $responseData = json_decode($response->getBody(), true);

            // Handle API failure
            if (!$responseData['meta']['success']) {
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to update slider data.')
                    ->withInput(); // Keep old input data
            }

            // If successful, return the data and show a success message
            return back()->with('success', 'Slider updated successfully')
                ->withInput($data); // Pre-fill the form with the user input

        } catch (RequestException $e) {
            // Handle the error if the request fails
            return back()->with('error', 'Error during API request: ' . $e->getMessage())
                ->withInput(); // Keep old input data
        }
    }


    public function store(Request $request)
    {

        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'action' => 'nullable|string|max:255',
            // 'action_link' => 'nullable|url|max:255',
            // 'second_action' => 'nullable|string|max:255',
            // 'second_action_link' => 'nullable|url|max:255',
            'order' => 'required|integer|min:1',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Prepare the data for the API
        $data = $request->only([
            'title',
            'description',
            'action',
            'action_link',
            'second_action',
            'second_action_link',
            'order',
        ]);

        // Prepare the multipart data for Guzzle
        $multipartData = [];

        // Add form fields
        foreach ($data as $key => $value) {
            $multipartData[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        // Add files if present
        if ($request->hasFile('image')) {
            $multipartData[] = [
                'name' => 'image',
                'contents' => fopen($request->file('image')->getRealPath(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }

        if ($request->hasFile('icon')) {
            $multipartData[] = [
                'name' => 'icon',
                'contents' => fopen($request->file('icon')->getRealPath(), 'r'),
                'filename' => $request->file('icon')->getClientOriginalName(),
            ];
        }

        // API endpoint
        $apiUrl = env('URL_BE') . 'slider/store';

        // Create the Guzzle client
        $client = new Client();

        try {
            // Make the POST request with Guzzle
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
                'multipart' => $multipartData, // Correctly formatted multipart data
            ]);

            // Decode the response
            $responseData = json_decode($response->getBody(), true);

            // Handle API failure
            if (!$responseData['meta']['success']) {
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to save slider data.')
                    ->withInput(); // Keep old input data
            }

            // If successful, return the data and show a success message
            return back()->with('success', 'Slider created successfully')
                ->withInput($data); // Pre-fill the form with the user input

        } catch (RequestException $e) {
            // Handle the error if the request fails
            return back()->with('error', 'Error during API request: ' . $e->getMessage())
                ->withInput(); // Keep old input data
        }
    }


    public function destroy(Request $request, $id)
    {
        // Retrieve the token from the session or cookie
        $token = $request->cookie('killaToken');

        // Instantiate Guzzle client
        $client = new Client();

        // Set the API URL (using your environment variable)
        $apiUrl = env('URL_BE') . 'slider/destroy/'.$id;

        try {
            // Send DELETE request with the Bearer token for authorization
            $response = $client->delete($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);

            // Check if the response is successful
            if ($response->getStatusCode() == 200) {
                return back()->with(["success" => "Data deleted successfully "]);
            } else {
                return back()->with(["error" => "Delete process failed with status: " . $response->getStatusCode()]);
            }
        } catch (\Exception $e) {
            // Handle exceptions such as network errors or connection issues
            return back()->with(["error" => "An error occurred: " . $e->getMessage()]);
        }
    }
}
