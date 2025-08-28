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
        return view('admin.auth.login');
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
        $credentials =$request->except('_token','remember');
        
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
        return redirect()->back()->with('error', 'Invalid email or password')->withInput();
        }
    }
}