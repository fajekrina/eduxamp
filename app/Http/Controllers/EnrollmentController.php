<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        return view('enrollment.index');
    }

    public function detail()
    {
        return view('enrollment.detail');
    }
    
    public function create()
    {
        return view('enrollment.create');
    }
    
    public function edit()
    {
        return view('enrollment.edit');
    }
}
