<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission; // Make sure this is imported

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

    //store method
    public function store(Request $request)
    {
        // validation rule
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name', // Ensures role name is unique in the 'roles' table
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.roles.create')->withErrors($validate)->withInput();
        }

  
        //icon upload
        $fileName = null;
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/role'), $fileName);
        }
            
        //auto genarate dashboard_route
        $dashboardRoute = strtolower($request->name) . '.dashboard';    



        // quarry
        Role::create([
            'name' => $request->name,
            'icon' => $fileName,
            'status' => $request->status,
            'guard_name' => 'web', 
            'dashboard_route' => $dashboardRoute,
        ]);
        return redirect()->route('admin.roles.list')->with('success', 'Role created successfully');
    }
    

    //update method
    public function update(Request $request, $id) {
       
        $role = Role::findOrFail($id);

        // validation
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
            // Update the role's attributes
            $role->update([
                'name' => $request->name,
                'icon' => $fileName,
                'status' => $request->status,
                'guard_name' => 'web', 
            ]);

            return redirect()->route('admin.roles.list')
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
         return redirect()->route('admin.roles.list')->with('success', 'Role deleted successfully');
    }








    //permission assign
   public function permissionAssign($id){
    $role = Role::find($id);
    $permissions = Permission::all();
    return view('admin.Role.permission-assign', compact('role', 'permissions'));
}


    //permission assign store
    public function permissionAssignStore(Request $request, $id){
        $role = Role::findOrFail($id);
        
        // Get the permission models from the submitted IDs
        $permissions = Permission::whereIn('id', $request->permissions ?? [])->pluck('name');
        
        // Sync all selected permissions by their names
        $role->syncPermissions($permissions);
        
        return redirect()->route('admin.roles.list')
            ->with('success', 'Permissions updated successfully');
    }

    
}