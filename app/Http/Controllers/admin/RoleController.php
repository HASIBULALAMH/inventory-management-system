<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function list()
    {
        $roles = Role::paginate(10);
        return view('admin.role.list', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    //store
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        //icon upload
        $fileName = null;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/role'), $fileName);
        }
            
        //role store
        Role::create([
            'name' => $request->name,
            'icon' => $fileName,
            'status' => $request->status,
        ]);
        return redirect()->route('roles.list')->with('success', 'Role created successfully');
    }
    
//edit
public function edit($id)
{
    $role = Role::find($id);
    return view('admin.role.edit', compact('role'));
}






    //delete
    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
         }
         return redirect()->route('roles.list')->with('success', 'Role deleted successfully');
    }
}