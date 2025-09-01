<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //list
    public function list(){
       
        return view('admin.user.list');
    }


    //create
    public function create(){
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }
}   
