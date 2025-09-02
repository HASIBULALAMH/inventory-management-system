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


   
}