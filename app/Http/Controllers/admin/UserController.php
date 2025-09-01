<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //list
    public function list(){
       
        return view('admin.user.list');
    }


    //create
    public function create(){
        return view('admin.user.create');
    }
}   
