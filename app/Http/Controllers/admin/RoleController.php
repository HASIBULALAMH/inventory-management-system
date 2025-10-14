<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Spatie\Permission\Models\Permission; // Make sure this is imported

class RoleController extends Controller
{
    public function list()
    {
      $roles = Role::with('parent')->paginate(10);

        return view('admin.role.list', compact('roles'));
    }

    public function create()
    {
           $role = new Role();
     $roles = Role::where('status', 'active')->get();
    return view('admin.role.create', compact('role', 'roles'));
    }

    //store method
    public function store(Request $request)
    {
        // validation rule
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles,name',
           'icon_class' => 'required|string|starts_with:fa-',
         'parent_id' => 'nullable|exists:roles,id',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->route('admin.roles.create')->withErrors($validate)->withInput();
        }

  
      
            
        //auto genarate dashboard_route
       $dashboardRoute = 'dashboard.' . strtolower(str_replace(' ', '_', $request->name));



        // quarry
        Role::create([
            'name' => $request->name,
            'icon_class' => $request->icon_class,
            'parent_id' => $request->parent_id?:null,
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
           'parent_id' => 'nullable|exists:roles,id',
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
                'parent_id' => $request->parent_id?:null,
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
       $roles = Role::where('status', 'active')->get();
        return view('admin.role.edit', compact('role', 'roles'));
    }

    // Delete a role
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        
        // Check if role has any children using direct query
        $hasChildren = Role::where('parent_id', $role->id)->exists();
        if ($hasChildren) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete this role because it has child roles. Please delete the child roles first.');
        }
        
        // Check if role is assigned to any users using direct query
        $hasUsers = DB::table('model_has_roles')
            ->where('role_id', $role->id)
            ->exists();
            
        if ($hasUsers) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete this role because it is assigned to one or more users.');
        }
        
        // Delete the role
        $role->delete();
        
        return redirect()
            ->route('admin.roles.list')
            ->with('success', 'Role deleted successfully');
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