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
 * Load JSON file
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

Route::get('/interactions/list', function() {

    //$users = App\model\Users::with('interactions')->get();
    $users = App\model\Users::with('interactions')
            ->get()
            ->sortByDesc(function($user) {
                    return $user->interactions->count();
                });
    
    $output = array();

    foreach ($users as $u) {
        
        $o = new stdClass();
        
        $o->id = $u->id;
        $o->name = $u->title.' '.$u->full_name;
        $o->num_interaction = $u->interactions->count();
        
        $output[] = $o;
    }
    
    return json_encode($output);
});
