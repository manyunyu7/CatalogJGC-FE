<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FasilitasTransactionController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('URL_BE') . 'fasilitas-transactions';
    }

    public function index(Request $request)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->get($this->apiBaseUrl);

        if ($response->successful()) {
            $transactions = collect($response->json()['result'])->map(function ($item) {
                return json_decode(json_encode($item));
            });

            return view('fasilitas-transactions.index', compact('transactions'));
        }

        return back()->with('error', 'Failed to fetch transactions');
    }

    public function create()
    {
        return view('fasilitas-transactions.create');
    }

    public function store(Request $request)
    {
        $token = $request->cookie('killaToken');

        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        $validatedData = $request->validate([
            'parent_id' => 'nullable|integer',
            'fasilitas_id' => 'required|exists:fasilitas,id',
        ]);

        $response = Http::withToken($token)->post($this->apiBaseUrl, $validatedData);

        $responseData = $response->json();

        if (!$responseData['meta']['success']) {
            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to create transaction.')
                ->withInput();
        }

        return redirect()->route('fasilitas-transactions.index')->with('success', 'Transaction created successfully');
    }

    public function edit(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/{$id}");

        if ($response->successful()) {
            $responseData = $response->json();

            if ($responseData['meta']['success']) {
                $transaction = (object) $responseData['result'];
                return view('fasilitas-transactions.edit', compact('transaction'));
            } else {
                return back()->with('error', $responseData['meta']['message'] ?? 'Failed to fetch transaction data');
            }
        }

        $errorMessage = $response->json()['meta']['message'] ?? 'Failed to fetch transaction data due to an unknown error';
        return back()->with('error', $errorMessage);
    }

    public function update(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        if (!$token) {
            return back()->with('error', 'User is not authenticated')->withInput();
        }

        $validatedData = $request->validate([
            'parent_id' => 'nullable|integer',
            'fasilitas_id' => 'sometimes|exists:fasilitas,id',
        ]);

        $response = Http::withToken($token)->put("{$this->apiBaseUrl}/{$id}", $validatedData);

        $responseData = $response->json();

        if (!$responseData['meta']['success']) {
            return back()->with('error', $responseData['meta']['message'] ?? 'Failed to update transaction.')
                ->withInput();
        }

        return redirect()->route('fasilitas-transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $token = $request->cookie('killaToken');

        $response = Http::withToken($token)->delete("{$this->apiBaseUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('fasilitas-transactions.index')->with('success', 'Transaction deleted successfully');
        }

        $errorMessage = $response->json()['meta']['message'] ?? 'Failed to delete transaction due to an unknown error';
        return back()->with('error', $errorMessage);
    }
}
