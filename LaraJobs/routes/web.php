<?php

use App\Models\Listings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('listings', [
        'heading' => 'Latest string',
        'listings' => Listings::all() 
    ]);
});

Route::get('/listings/{id}', function($id){

    return view('listing',[
        'listing' => Listings::find($id)
    ]);

});