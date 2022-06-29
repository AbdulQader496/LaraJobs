<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
// Show all the listings
Route::get('/', [ListingController::class, 'index']);

// Create New users
Route::post('/user', [UserController::class, 'store']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// Register user
Route::get('/register', [UserController::class, 'register']);

// Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update
Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Delete
Route::delete('/listings/{listing}', [ListingController::class, 'delete']);

// Store list data
Route::post('/listings', [ListingController::class, 'store']);

// show single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing 