<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use App\Models\State;

class StateController extends Controller
{
    //list
    public function list()
    {
        $states = State::paginate(10);
        return view('admin.location.state.list', compact('states'));
    }

    //create
    public function create()
    {
        $countries = Country::all();
        return view('admin.location.state.create', compact('countries'));
    }


    //store
    public function store(Request $request)
    {
       //validate
       $validateData = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:states,code',
        'status' => 'required|in:active,inactive',
        'slug' => 'required|string|max:100|unique:states,slug',
        'country_id' => 'required',
       ]);

       if ($validateData->fails()) {
        return redirect()->back()->withErrors($validateData)->withInput();
       }

       State::create([
        'name' => $request->name,
        'code' => $request->code,
        'status' => $request->status,
        'country_id' => $request->country_id,
        'slug' => $request->slug,
       ]);
       return redirect()->route('admin.locations.states.list')->with('success', 'State created successfully');
    }

    //edit
    public function edit($id)
    {
        $state = State::findOrFail($id);
        $countries = Country::all();
        return view('admin.location.state.edit', compact('state', 'countries'));
    }

    //update
    public function update(Request $request, $id)
    {
       //validate
       $validateData = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10|unique:states,code,'.$id,
        'status' => 'required|in:active,inactive',
        'slug' => 'required|string|max:100|unique:states,slug,'.$id,
        'country_id' => 'required',
       ]);

       if ($validateData->fails()) {
        return redirect()->back()->withErrors($validateData)->withInput();
       }

       $state = State::findOrFail($id);
       $state->update([
        'name' => $request->name,
        'code' => $request->code,
        'status' => $request->status,
        'country_id' => $request->country_id,
        'slug' => $request->slug,
       ]);
       return redirect()->route('admin.locations.states.list')->with('success', 'State updated successfully');
    }

    //delete
    public function delete($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        return redirect()->route('admin.locations.states.list')->with('success', 'State deleted successfully');
    }

   
}
