<?php

namespace App\Http\Controllers;

use App\Models\blob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
       
      
        try {
            // Retrieve the uploaded image
            $image = $request->file('image');

            // Check if the image size is less than or equal to 20kb
            if (!$image) {
                return Redirect::back()->withErrors([
                    'img_err' => 'No image found!',
                ]);
            } else if ($image->getSize() > 20000) {
                // Compress the image using Intervention library
                $compressed_image = Image::make($image)->widen(500)->encode('jpg', 80);

                // Save the compressed image to the database
                blob::create([
                    'image' => $compressed_image->__toString(),
                ]);
            } else {
                // Save the original image
                $image_data = file_get_contents($image->getPathname());
                blob::create([
                    'image' => $image_data,
                ]);
            }

            // Redirect to a success page
            return response('yes');
        } catch (Exception $err) {
            return Redirect::back()->withErrors([
                'img_err' => 'There is an error!',
            ]);
        }
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
