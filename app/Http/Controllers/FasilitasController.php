<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FasilitasController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('URL_BE') . 'fasilitas';
    }

    public function index(Request $request)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->get($this->apiBaseUrl);

        if ($response->successful()) {
            $fasilitas = collect($response->json()['result'])->map(function ($item) {
                return json_decode(json_encode($item));
            });

            return view('fasilitas.index', compact('fasilitas'));
        }

        return back()->with('error', 'Failed to fetch facilities');
    }

    public function create()
    {
        return view('fasilitas.create');
    }

    public function store(Request $request)
    {
        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        // Validate the request (Modify validation as per your needs)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // Prepare multipart data dynamically
        $multipartData = [];

        // Add all text fields from the request
        foreach ($request->except(['icon']) as $key => $value) {
            $multipartData[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        // Add all uploaded files dynamically
        foreach ($request->files->all() as $key => $file) {
            if ($file->isValid()) {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => fopen($file->getRealPath(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                    'headers' => ['Content-Type' => $file->getMimeType()],
                ];
            }
        }

        // Send the request with multipart form-data
        $response = Http::withToken($token)
            ->asMultipart()
            ->post($this->apiBaseUrl, $multipartData);

        // Decode the response
        $responseData = json_decode($response->getBody(), true);

        // Handle API failure
        if (!$responseData['meta']['success']) {
            // If the API response contains a specific error message, show it; otherwise, fallback to a default message
            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to create facility data.')
                ->withInput(); // Keep old input data
        }

        // If successful, return the data and show a success message
        return redirect()->route('fasilitas.index')->with('success', 'Facility created successfully');
    }

    public function edit(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/{$id}");

        if ($response->successful()) {
            $responseData = $response->json();

            // Check if the API indicates success
            if ($responseData['meta']['success']) {
                $fasilitas = (object) $responseData['result'];
                return view('fasilitas.edit', compact('fasilitas'));
            } else {
                // If success is false in the API response, show the message from the API
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to fetch facility data');
            }
        }

        // Handle non-successful responses (4xx, 5xx) and parse error message from the API
        $errorMessage = $response->json()['meta']['message'] ?? 'Failed to fetch facility data due to an unknown error';
        return back()->with('error', $errorMessage);
    }


    // Validate the request (Modify validation as per your needs)
    //   $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'description' => 'nullable|string',
    //     'icon' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
    // ]);
    public function update(Request $request, $id)
    {
        // Retrieve the token from session
        $token = $request->cookie('killaToken');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Prepare the data for the API
        $data = $request->only([
            'name', // Using 'title' instead of 'name' to match the form fields
            'description',
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
        $files = ['icon']; // List of possible files
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
        $apiUrl = "{$this->apiBaseUrl}/{$id}/update"; // Adjust your API URL accordingly

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
                // If the API indicates failure, show the error message and keep the user input
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to update data.')
                    ->withInput(); // Keep old input data
            }

            // If successful, return the data and show a success message
            return back()->with('success', 'Data updated successfully')
                ->withInput($data); // Pre-fill the form with the user input

        } catch (RequestException $e) {
            // Handle the error if the request fails
            return back()->with('error', 'Error during API request: ' . $e->getMessage())
                ->withInput(); // Keep old input data
        }
    }


    public function destroy(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        // Make the DELETE request to the API
        $response = Http::withToken($token)->delete("{$this->apiBaseUrl}/{$id}");

        // Check if the response is successful
        if ($response->successful()) {
            return redirect()->route('fasilitas.index')->with('success', 'Facility deleted successfully');
        }

        // Handle failure - check if the API response has an error message
        $errorMessage = $response->json()['meta']['message'] ?? 'Failed to delete facility due to an unknown error';

        // Redirect back with the error message and keep old input data
        return back()->with('error', $errorMessage);
    }
}
