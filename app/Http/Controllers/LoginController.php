<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Assuming you're using Laravel's built-in authentication system
        // to authenticate the user by email and password.
        // You should attempt to authenticate the user using the provided credentials.
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Check if the authenticated user's email is verified
            if (auth()->user()->email_verified_at) {
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('error', 'Your account is not yet verified');
            }
        } else {
            // Authentication failed
            return redirect('/')->with('error', 'Invalid credentials');
        }
    }
}
