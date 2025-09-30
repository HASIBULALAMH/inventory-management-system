<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Warehouse;
class WarehouseController extends Controller
{
    //list
    public function list()
    {
        $warehouses = Warehouse::with(['city', 'state', 'country', 'supervisor'])->paginate(10);
        return view('warehouse.list', compact('warehouses'));
    }
    //create
    public function create()
    {
        $countries = Country::all();
        $users = User::all();
        return view('warehouse.create', compact('countries', 'users'));
    }
   
    //ajex
    public function getStates(Country $country)
    {
         $states = $country->states;
         return response()->json($states);
    }
    
    public function getCities(State $state)
    {
         $cities = $state->cities;
         return response()->json($cities);
    }
    
    public function getZipcode(City $city)
    {
         return response()->json(['zipcode' => $city->zip_code]);
    }
    
    public function getManager(User $user)
    {
         return response()->json([
             'email' => $user->email,
             'phone' => $user->phone
         ]);
    }
}
