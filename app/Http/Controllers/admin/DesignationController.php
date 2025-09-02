<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
class DesignationController extends Controller
{
    //list
    public function list(){
        return view('admin.designation.list');
    }

    //create
    public function create(){
        $departments = Department::all();
        return view('admin.designation.create', compact('departments'));
    }
}
