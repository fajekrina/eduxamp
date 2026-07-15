<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index');
    }

    public function detail()
    {
        return view('user.detail');
    }
    
    public function create()
    {
        return view('user.create');
    }
    
    public function edit()
    {
        return view('user.edit');
    }
}
