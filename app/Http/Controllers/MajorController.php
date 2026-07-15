<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        return view('major.index');
    }

    public function detail()
    {
        return view('major.detail');
    }
    
    public function create()
    {
        return view('major.create');
    }
    
    public function edit()
    {
        return view('major.edit');
    }
}
