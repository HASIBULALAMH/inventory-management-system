<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role; // Make sure this is imported

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

    //store method - START OF CHANGES
    public function store(Request $request)
    {
        // Line 25: Add 'unique:roles,name' validation rule
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name', // Ensures role name is unique in the 'roles' table
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // --- Optional explicit check (the unique rule above is usually enough) ---
        // If you want a specific custom message for this, you can keep this check.
        // Otherwise, the validator will handle the 'unique' error message.
        /*
        if (Role::where('name', $request->name)->where('guard_name', 'web')->exists()) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'A role with this name already exists for the web guard.');
        }
        */
        // --- End of Optional explicit check ---


        //icon upload
        $fileName = null;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/role'), $fileName);
        }
            
        // Line 51: role store - Add 'guard_name' explicitly
        Role::create([
            'name' => $request->name,
            'icon' => $fileName,
            'status' => $request->status,
            'guard_name' => 'web', // Explicitly set the guard name
        ]);
        return redirect()->route('roles.list')->with('success', 'Role created successfully');
    }
    //store method - END OF CHANGES

    //update method - START OF CHANGES
    public function update(Request $request, $id) {
        // Line 60: Find the role first before validation
        $role = Role::findOrFail($id);

        // Line 63: Add 'unique:roles,name,' . $id to ignore the current role's ID
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name,' . $id, // Ignores current role's ID for uniqueness check
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

     

        // Handle file upload 
        $fileName = $role->icon;
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($role->icon && file_exists(public_path('uploads/role/' . $role->icon))) {
                unlink(public_path('uploads/role/' . $role->icon));
            }
            
            $file = $request->file('icon');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/role'), $fileName);
        }

        try {
            // Line 106: Update the role's attributes - Add 'guard_name' explicitly
            $role->update([
                'name' => $request->name,
                'icon' => $fileName,
                'status' => $request->status,
                'guard_name' => 'web', // Explicitly set the guard name
            ]);

            return redirect()->route('roles.list')
                           ->with('success', 'Role updated successfully');

        } catch (\Exception $e) {
            // Line 116: If there's an error and a new file was uploaded, delete it
            if ($request->hasFile('icon') && file_exists(public_path('uploads/role/' . $fileName))) {
                unlink(public_path('uploads/role/' . $fileName));
            }
            
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Error updating role: ' . $e->getMessage());
        }
    }
    //update method - END OF CHANGES

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
            // Line 133: Before deleting, ensure to delete the associated icon file if it exists
            if ($role->icon && file_exists(public_path('uploads/role/' . $role->icon))) {
                unlink(public_path('uploads/role/' . $role->icon));
            }
            $role->delete();
         }
         return redirect()->route('roles.list')->with('success', 'Role deleted successfully');
    }
}