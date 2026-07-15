<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $hour = now()->hour;

        $greeting = 'Good Morning';
        if ($hour > 12) $greeting = 'Good Afternoon';
        if ($hour > 17) $greeting = 'Good Evening';

        return view('dashboard', compact('greeting'));
    }
}
