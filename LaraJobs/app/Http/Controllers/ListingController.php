<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all jobs listings
    public function index() {
        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag','search']))->paginate(10) 
        ]);

    }

    // show single listing
    public function show(Listings $listing) {
        return view('listings.show',[
            'listing' => $listing
        ]);
    }
    // show create form
    public function create() {
        return view('listings.create');
    }

    // Store Data 
    public function store(Request $request) {
        
        $formField = $request->validate([
            'title' => 'required',
            'company-name' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos','public');
        }
        Listings::create($formField);

        

        return redirect('/')->with('message', 'Listing created successfully!');
    }
        
    
}
