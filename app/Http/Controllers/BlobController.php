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
                // Compress the image using TinyPNG API
                $api_key = env('TINYPNG_API_KEY');
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://api.tinify.com/shrink', [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode('api:' . $api_key),
                    ],
                    'body' => file_get_contents($image->getPathname()),
                ]);

                $compressed_data = json_decode((string) $response->getBody());
                $compressed_url = $compressed_data->output->url;

                // Download the compressed image and save it to the database
                $compressed_image_data = file_get_contents($compressed_url);
                blob::create([
                    'image' => $compressed_image_data,
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
