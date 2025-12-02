<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Login page show panu 
    public function showLogin()
    {
        return view('auth.login-page');
    }

    // Register page show panu 
    public function showRegister()
    {
        return view('auth.register-page');
    }

    // Register tah irunthu post agurah data vah eduka
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

    $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/create-profile')->with('success','Account Created');
    }

    // Login tah iruthu post agurah data vah eduka 
   public function login(Request $request)
{
    // Step 1: Validate basic input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5',
    ]);

    // Step 2: Check if email exists
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'This email is not registered.',
        ])->withInput();
    }

    // Step 3: Check password
    if (!\Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Incorrect password.',
        ])->withInput([
            'email' => $request->email, // keep email
            'password' => ''            // clear password
        ]);
    }

    // Step 4: Login success
    Auth::login($user);
    return redirect('/home')->with('success','Login Successfully');
}
}


