<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Permission;

class PermissionController extends Controller
{
    //list
    public function list(){
        $permissions = Permission::paginate(10); // Show 10 permissions per page
        return view('admin.permission.list', compact('permissions'));
    }

    //create
    public function create(){
        return view('admin.permission.create');
    }

    //store
    public function store(Request $request){
        //dd($request->all());

        //validate
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required|in:web,api',
            'status' => 'required|in:active,inactive',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        //query
       
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.permissions.list')->with('success', 'Permission created successfully');
    }
}
