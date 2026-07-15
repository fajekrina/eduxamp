<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return view('student.index');
    }

    public function detail()
    {
        return view('student.detail');
    }
    
    public function create()
    {
        return view('student.create');
    }
    
    public function edit()
    {
        return view('student.edit');
    }
}
