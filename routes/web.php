<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {

    $brands = App\model\Brands::all();

    foreach ($brands as $b) {
        echo $b->name;
    }
    //return view('welcome');
});
