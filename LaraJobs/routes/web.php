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

// Login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User
Route::post('/user/authenticate', [UserController::class, 'authenticate']);

// Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Register user
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');

// Store list data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

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