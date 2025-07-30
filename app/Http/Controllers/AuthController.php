<?php

namespace App\Http\Controllers;

use App\Models\User;
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


            $user->last_login = now();



            $userAgent = $request->header('User-Agent');
            $browser = 'Other';
            $device = 'Desktop';
            if (strpos($userAgent, 'Edg') !== false) {
                $browser = 'Edge';
            } elseif (strpos($userAgent, 'Chrome') !== false) {
                $browser = 'Chrome';
            } elseif (strpos($userAgent, 'Firefox') !== false) {
                $browser = 'Firefox';
            } elseif (strpos($userAgent, 'Safari') !== false) {
                $browser = 'Safari';
            }

            if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false) {
                $device = 'Mobile';
            } elseif (strpos($userAgent, 'Tablet') !== false) {
                $device = 'Tablet';
            }

            $user->browser = $browser;
            $user->device = $device;
            $user->save();

            if ($user->role == 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome Admin');
            } elseif ($user->role == 'customer') {
                return redirect()->intended(route('customer.latestFuniture'))->with('success', 'Welcome User');
            } else {
                return redirect()->back()->with('error', 'Unauthorized user type');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }


    public function customerRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $user->role = 'customer';
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('users', 'public');
        }
        $user->save();



        return redirect()->route('login')->with('success', 'Registration successful, please login');




    }

}



