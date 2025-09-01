<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //list
    public function list(){
        $search = request()->query('search');
        $filter = request()->query('filter');

        $query = User::query();
        //search
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }
        //filter
        if ($filter) {
            $query->where('role', $filter);
        }

        $users = $query->paginate(10);

        return view('admin.user.list', compact('users','search','filter'));
    }


    //create
    public function create(){
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }


    //store
    public function store(Request $request)
    {
        try {
            // Validation
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'dob' => 'required|date',
                'phone' => 'required|string|max:20',
                'present_address' => 'required|string',
                'job_title' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:8|max:255|confirmed',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
                'role' => 'required|exists:roles,id',
                'status' => 'required|in:active,inactive',
            ]);
            
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            // Image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $path = public_path('uploads/user');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $file->move($path, $fileName);
            } else {
                return redirect()->back()->with('error', 'Image upload failed. Please try again.')->withInput();
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'present_address' => $request->present_address,
                'job_title' => $request->job_title,
                'department' => $request->department,
                'experience' => $request->experience,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $fileName,
                'role' => $request->role,
                'status' => $request->status,
                'email_verified_at' => now(),
            ]);

            // Assign role to user
            $role = Role::findById($request->role);
            $user->assignRole($role);

            return redirect()->route('admin.users.list')->with('success', 'User created successfully');
            
        } catch (\Exception $e) {
            // Log the error using the fully qualified namespace
            if (class_exists('\\Illuminate\\Support\\Facades\\Log')) {
                \Illuminate\Support\Facades\Log::error('Error creating user: ' . $e->getMessage());
            }
            
            // If there's an error, delete the uploaded image if it exists
            if (isset($fileName) && file_exists(public_path('uploads/user/' . $fileName))) {
                unlink(public_path('uploads/user/' . $fileName));
            }
            
            return redirect()->back()
                ->with('error', 'Error creating user. Please try again.')
                ->withInput();
        }
    }
}