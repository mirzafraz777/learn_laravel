<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listing
    public function index(Request $request){
        // dd($request->tag);
        // dd($request->search);
        return view('listings.index' , ['listings'=>Listing::latest()->filter(['tag'=>$request->tag, 'search'=>$request->search ])->get()]);
    }
    // show single listing
    //Route binding Model method
    public function show(Listing $listing){
        return view('listings.show',['listing'=>$listing]);
    }

    // Show create form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data From Form
    public function store(Request $request) {
        
        // dd($request->all());

        $formRules = [
            'company' => ['required', Rule::unique('listings','company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ];

        $formFields = $request->validate($formRules);

        Listing::create($formFields);

        return redirect('/');

    }

}
