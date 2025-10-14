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
        $role = new Role();
        return view('admin.role.create', compact('role'));
    }

    //store method
    public function store(Request $request)
    {
        // validation rule
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name',
           'icon_class' => 'required|string|starts_with:fa-',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.roles.create')->withErrors($validate)->withInput();
        }

  
      
            
        //auto genarate dashboard_route
        $dashboardRoute = strtolower($request->name) . '.dashboard';    



        // quarry
        Role::create([
            'name' => $request->name,
            'icon_class' => $request->icon_class,
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
            'name' => 'required|max:255|unique:roles,name,' . $id,
           'icon_class' => 'required|string|starts_with:fa-',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

     

        try {
            // Update the role's attributes
            $role->update([
                'name' => $request->name,
                'icon_class' => $request->icon_class,
                'status' => $request->status,
                'guard_name' => 'web', 
            ]);

            return redirect()->route('admin.roles.list')
                           ->with('success', 'Role updated successfully');

        } catch (\Exception $e) {
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