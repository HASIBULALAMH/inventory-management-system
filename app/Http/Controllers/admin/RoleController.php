<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function list()
    {
        return view('admin.role.list');
    }

    public function create()
    {
        return view('admin.role.create');
    }
}
