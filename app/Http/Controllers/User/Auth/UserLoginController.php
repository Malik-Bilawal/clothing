<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure to import the User model

class UserLoginController extends Controller
{
    public function index()
    {
        return view('user.Auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('verification.notice')
                    ->with('error', 'Please verify your email before logging in.');
            }

            if ($user->role === User::ROLE_ADMIN) {
                return redirect()->intended('/admin/product');
            }

            return redirect()->intended('/'); 
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.show'); 
    }
}