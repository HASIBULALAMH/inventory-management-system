<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UserController extends Controller
{
    // User List
    public function list(Request $request)
    {
        $query = User::with(['roles', 'designation', 'department']); // eager load

        // Search by name, email, phone
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->role . '%');
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pagination
        $users = $query->paginate(10);
        $roles = Role::all();

        return view('admin.user.list', compact('users', 'roles'));
    }

    // Show create user form
    public function create()
    { 
        $countries = Country::all();
        $roles = Role::all();
        $designations = Designation::all();
        $departments = Department::all();
        return view('admin.user.create', compact('roles', 'designations', 'departments', 'countries'));
    }

    // Store new user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'employee_id' => 'required|string|unique:users,employee_id',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'join_date' => 'required|date',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'role' => 'required|exists:roles,id',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zip_code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle file upload
        $filename = null;
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_photos'), $filename);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'join_date' => $request->join_date,
            'profile_photo' => $filename,
            'status' => $request->status,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
        ]);

        // Assign role
        $role = Role::find($request->role);
        if ($role) {
            $user->assignRole($role->name);
        }
        
        return redirect()->route('admin.users.list')
            ->with('success', 'User created successfully');
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
}
