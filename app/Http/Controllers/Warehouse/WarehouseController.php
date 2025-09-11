<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //list
    public function list(){
        return view('warehouse.list');
    }

    //create
    public function create(){
        return view('warehouse.create');
    }
}
