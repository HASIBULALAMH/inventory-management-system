<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use App\Models\Designation;

class DesignationController extends Controller
{
    //list
    public function list(){
        $designations = Designation::paginate(10);
        return view('admin.designation.list', compact('designations'));
    }

    //create
    public function create(){
        $departments = Department::all();
        return view('admin.designation.create', compact('departments'));
    }

    //store
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:designations,name',
            'code' => 'required|max:255|unique:designations,code',
            'department_id' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Designation::create([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.designations.list')->with('success', 'Designation created successfully');
    }


    //edit
    public function edit($id){
        $designation = Designation::findOrFail($id);
        $departments = Department::all();
        return view('admin.designation.edit', compact('designation', 'departments'));
    }


    //update
    public function update(Request $request, $id){
        $designation = Designation::findOrFail($id);
        
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:designations,name,' . $id,
            'code' => 'required|string|max:255|unique:designations,code,' . $id,
            'department_id' => 'required|exists:departments,id',
            'status' => 'required|in:active,inactive',
        ], [
            'department_id.exists' => 'The selected department is invalid.',
            'name.unique' => 'This designation name is already in use.',
            'code.unique' => 'This code is already in use.',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        try {
            $designation->update([
                'name' => $request->name,
                'code' => $request->code,
                'department_id' => $request->department_id,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('admon.designations.list')
                ->with('success', 'Designation updated successfully');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating designation: ' . $e->getMessage())
                ->withInput();
        }
    }

    //delete
    public function delete($id){
        $designation = Designation::findOrFail($id);
        $designation->delete();
        return redirect()->route('admin.designations.list')->with('success', 'Designation deleted successfully');
    }
}
