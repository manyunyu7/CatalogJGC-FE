<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{
    public function viewAdminManage()
    {
        // Retrieve the token from session
        $token = session('token');

        // Ensure the token is available
        if (!$token) {
            return back()->with('error', 'User is not authenticated');
        }


        $response = Http::withToken($token)
            ->get(env('URL_BE') . 'cms-user/manage');


        if ($response->successful()) {
            $users = collect($response->json()['result'])->map(function ($user) {
                return (object) $user; // Convert each user array to an object
            });

            return view('karyawan.manage', compact('users'));
        }

        return back()->with('error', 'Failed to fetch users');
    }


    public function viewAdminEdit($id)
    {

        // Retrieve the token from session
        $token = session('token');


        // Get user and address data from the backend API
        $userResponse = Http::withToken($token)->get(env('URL_BE') . "cms-user/edit/{$id}");


        if ($userResponse->successful()) {
            $users = (object) $userResponse->json()['result']['users']; // Cast to object
            return view('karyawan.edit', compact('users'));
        }

        return back()->with('error', 'Failed to fetch user data');
    }

    public function viewAdminCreate()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        // Retrieve the token from session
        $token = session('token');

        $response = Http::withToken($token)->post(env('URL_BE') . 'cms-user/store', [
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_contact' => $request->user_contact,
            'user_password' => $request->user_password,
            'user_role' => $request->user_role,
            'address' => $request->address,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'User created successfully');
        }

        return back()->with('error', 'Failed to create user');
    }

    public function update(Request $request)
    {
        $token = session('token');

        $response = Http::withToken($token)->put(env('URL_BE') . '/cms-user/update', [
            'id' => $request->id,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_contact' => $request->user_contact,
            'user_password' => $request->user_password,
            'user_role' => $request->user_role,
            'address_id' => $request->address_id,
            'address' => $request->address,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'User updated successfully');
        }

        return back()->with('error', 'Failed to update user');
    }

    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete(env('URL_BE') . "cms-user/destroy/{$id}");


        if ($response->successful()) {
            return back()->with('success', 'User deleted successfully');
        }

        return back()->with('error', 'Failed to delete user');
    }
}
