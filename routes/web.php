<?php

use App\Http\Controllers\BlobController;
use App\Models\blob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/show", function () {
    // Retrieve the BLOB data from the database
    $images = blob::all();
    return view('show', ['images' => $images]);
});

Route::apiResource("upload", BlobController::class);
