<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //List
    public function list()
    {
        $branches = Branch::with('location.country',
        'location.state',
        'location.city',
        'location.thana',
        'location.union')->paginate(10);
        return view('admin.branch.list', compact('branches'));
    }

    //Create
    public function create()
    {
        $countries = Country::all();
        return view('admin.branch.create', compact('countries'));
    }


    // AJAX routes
    public function getStates($countryId){
        $country = Country::find($countryId);
        return response()->json($country ? $country->states : []);
    }

    public function getCities($stateId){
        $state = State::find($stateId);
        return response()->json($state ? $state->cities : []);
    }

    public function getThanas($cityId){
        $city = City::find($cityId);
        return response()->json($city ? $city->thanas : []);
    }

    public function getUnions($thanaId){
        $thana = Thana::with('unions')->find($thanaId);
        return response()->json($thana ? $thana->unions : []);
    }

    public function getZipcode($unionsId){
        $union = Union::find($unionsId);
        return response()->json([
            'zipcode' => $union->zipcode ?? $union->zip_code ?? ''
        ]);
    }

}
