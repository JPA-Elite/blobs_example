<?php

namespace App\Http\Controllers;

use App\Models\blob;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BlobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {




        // Retrieve the uploaded image
        $image = $request->file('image');

        // Resize the image to the desired dimensions
        $max_width = 800;
        $image = Image::make($image);
        if ($image->width() > $max_width) {
            $image->resize($max_width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        // Compress the image and save it in JPEG format
        $image_data = $image->encode('jpg', 50)->__toString();

        // Store the compressed image as a BLOB in the database
        blob::create([
            'image' => $image_data
        ]);
        // Redirect to a success page
        return response('yes');
    }

    /**
     * Display the specified resource.
     */
    public function show(blob $blob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blob $blob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blob $blob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blob $blob)
    {
        //
    }
}
