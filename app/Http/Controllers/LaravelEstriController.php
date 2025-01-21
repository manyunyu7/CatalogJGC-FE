<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaravelEstriController extends Controller
{
    public function imageUpload()
    {
        return view('imageUpload');
    }

    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $path = Storage::disk('s3')->put('images', $request->image);
        $path = Storage::disk('s3')->url($path);

        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image', $path);
    }
}
