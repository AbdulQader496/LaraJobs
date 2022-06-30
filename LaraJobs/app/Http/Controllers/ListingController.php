<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
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
        
        $formFields = $request->validate([
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

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);        

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Edit form

    public function edit(Listings $listing) {
        
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update listing data
    public function update(Request $request, Listings $listing) {

        // Make sure logged user os owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }


        $formFields = $request->validate([
            'title' => 'required',
            'company-name' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);

        

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete
    
    public function delete(Listings $listing) {
        // Make sure logged user os owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing-> delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');

    }

    public function manage(){

        

        return view('listings.manage', ['listings'=>auth()->user()->listings()->get()]);

    }
    
}
