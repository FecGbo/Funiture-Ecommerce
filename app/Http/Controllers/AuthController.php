<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function checkAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin');
            } elseif ($user->role == 'customer') {
                return redirect()->route('welcome')->with('success', 'Welcome User');
            } else {
                return redirect()->back()->with('error', 'Unauthorized user type');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }


}
