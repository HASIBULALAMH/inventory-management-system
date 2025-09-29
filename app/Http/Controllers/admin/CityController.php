<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    //list  
    public function list()
    {
        $cities = City::paginate(10);
        return view('admin.location.city.list', compact('cities'));
    }

    //create
    public function create()
{
    $countries = Country::all();
    $states = State::all();
    return view('admin.location.city.create', compact('countries', 'states'));
}

   

    //store
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id'   => 'nullable|exists:states,id',
            'name'       => 'required|string|max:255',
            'zip_code'   => 'required|string|max:255',
            'status'     => 'required|in:active,inactive',
        ]);
    
        // Auto-generate unique code
        $baseCode = strtoupper(substr($request->name, 0, 3));
        $code = $baseCode;
        $counter = 1;
        while(City::where('code', $code)->exists()) {
            $code = $baseCode . $counter;
            $counter++;
        }
    
        // Auto-generate unique slug
        $slugBase = strtolower(str_replace(' ','-', $request->name));
        $slug = $slugBase;
        $slugCounter = 1;
        while(City::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $slugCounter;
            $slugCounter++;
        }
    
        City::create([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'name'       => $request->name,
            'zip_code'   => $request->zip_code,
            'code'       => $request->code,
            'slug'       => $request->slug,
            'status'     => $request->status,
        ]);
    
        return redirect()->route('admin.locations.cities.list')->with('success', 'City created successfully!');
    }

    //edit
    public function edit($id)
    {
        $city = City::findOrFail($id);
        $countries = Country::all();
        $states = State::where('country_id', $city->country_id)->get();
        return view('admin.location.city.edit', compact('city', 'countries', 'states'));

    }

    //update

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'country_id' => 'required|exists:countries,id',
            'state_id'   => 'nullable|exists:states,id',
            'name'       => 'required|string|max:255',
            'zip_code'   => 'required|string|max:255',
            'status'     => 'required|in:active,inactive',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $city->update([
            'country_id' => $request->country_id,
            'state_id'   => $request->state_id,
            'name'       => $request->name,
            'zip_code'   => $request->zip_code,
            'code'       => $request->code,
            'slug'       => $request->slug,
            'status'     => $request->status,
        ]);
        return redirect()->route('admin.locations.cities.list')->with('success', 'City updated successfully!');
    }
}