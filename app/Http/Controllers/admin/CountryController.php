<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    //list
    public function list()
    {
        $countries = Country::paginate(10); // Show 10 items per page
        return view('admin.location.country.list', compact('countries'));
    }

    //create
    public function create()
    {
        return view('admin.location.country.create');
    }

    //store
    public function store(Request $request)
    {
       $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
            'status' => 'required|in:active,inactive',
            'phone_code' => 'required|numeric',
             ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        Country::create([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
            'phone_code' => $request->phone_code,
        ]);

        return redirect()->route('admin.locations.countries.list')->with('success', 'Country created successfully');
    }

    //edit
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.location.country.edit', compact('country'));
    }

    //update
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
       
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
            'status' => 'required|in:active,inactive',
            'phone_code' => 'required|numeric',
        ]);
       
        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }
       
        $country->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
            'phone_code' => $request->phone_code,
        ]);
       
        return redirect()->route('admin.countries.list')->with('success', 'Country updated successfully');
    }

    //delete
    public function delete($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->route('admin.countries.list')->with('success', 'Country deleted successfully');
    }
}
