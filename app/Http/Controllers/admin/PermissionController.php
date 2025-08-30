<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //list
    public function list(){
        return view('admin.permission.list');
    }

    //create
    public function create(){
        return view('admin.permission.create');
    }
}
