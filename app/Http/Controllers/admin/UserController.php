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

class UserController extends Controller
{
    //list
    public function list(){
      
        return view('admin.user.list');
    }


    //create
    public function create(){
        $roles = Role::all();
        $designations = Designation::all();
        $departments = Department::all();
        return view('admin.user.create', compact('roles','designations','departments'));
    }

    //store
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
            'password_confirmation' => 'required|string|min:8|same:password',
            'phone' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'employee_id' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'role' => 'required|string|max:255',
            'join_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //user image
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/users'), $filename);
           
        }


       User::create([
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
        'role' => $request->role,
        'join_date' => $request->join_date,
        'profile_photo' => $filename,
        'status' => $request->status,
       ]);
        return redirect()->route('admin.users.list')->with('success', 'User created successfully');
    }   


   
}