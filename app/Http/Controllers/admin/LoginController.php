<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('auth.login');
    }
       

    public function login(Request $request)
    {
        //dd($request->all());
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

    //dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        // Get only email & password
        $credentials = $request->only('email', 'password');

        //dd($credentials);
        if (Auth::attempt($credentials)) {
       
            $user = Auth::user();
            
            // Get the first role of the user
            $role = $user->roles->first();
            
            if ($role) {
                return redirect()->route($role->dashboard_route);
            }
            
            // If no role is assigned, redirect to a default route
            return redirect()->route('dashboard')->with('error', 'No role assigned. Please contact administrator.');
        }

        return redirect()->route('login')
            ->withErrors(['email' => 'The provided credentials do not match our records.']);
     }
}