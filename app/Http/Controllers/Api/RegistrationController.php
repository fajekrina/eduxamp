<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function sign_in(Request $request)
    {
        // dd($request->email);
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
            
        // dd('HERE');    
        if (!Auth::attempt($credential)) {
            return back()
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ])
                ->withInput();
        }
    // dd('HERE2');    
        $request->session()->regenerate();

        session([
            'role_id' => auth()->user()->role_id,
        ]);

        return redirect('/dashboard');
    }

    public function sign_up(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $studentRole = Role::where('role_name', 'Student')->first();

        User::create([
            'role_id' => $studentRole->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Account created successfully.');
    }

    public function sign_out(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}