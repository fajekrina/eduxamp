<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return view('role.index');
    }

    public function detail()
    {
        return view('role.detail');
    }
    
    public function create()
    {
        return view('role.create');
    }
    
    public function edit()
    {
        return view('role.edit');
    }
}
