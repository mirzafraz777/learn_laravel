<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listing
    public function index(Request $request)
    {
        // dd($request->tag);
        // dd($request->search);
        return view('listings.index', [
            'listings' => Listing::latest()
                ->filter(['tag' => $request->tag, 'search' => $request->search])
                ->paginate(6),
        ]);
    }

    // show single listing
    //Route binding Model method
    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    // Show create form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data From Form
    public function store(Request $request)
    {
        // dd($request->file('logo'));

        $formRules = [
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ];

        $formFields = $request->validate($formRules);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully.');
    }

    // Show Edit Form
    //Route binding Model method
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        $formRules = [
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ];

        $formFields = $request->validate($formRules);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing Update Successfully.');
    }

    // Delete Listing
    public function delete(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully.');
    }
}
