<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**
 * 
 */
Route::get('/load-json/{filename}', function(String $filename) {

    $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

    if (file_exists($path)) {
        $file = file_get_contents($path); // string
        $records = json_decode($file, true);
    } else {
        App::abort(404, 'Record not found');
    }
    
    return $records;
});
