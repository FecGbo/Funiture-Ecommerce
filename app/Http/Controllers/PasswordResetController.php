<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email not found');
        }
        $token = \Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );
        $link = url('/reset-password/' . $token);
        Mail::raw("Click here to reset your password: $link", function ($message) use ($user) {
            $message->to($user->email)->subject('Password Reset Link');
        });
        return back()->with('success', 'Password reset link sent to your email.');
    }

 
    public function showResetForm($token)
    {  
        $record=DB::table('password_resets')->where('token',$token)->first();
        if (!$record) {
            return redirect()->route('password.request')->with('error', 'Invalid or expired token.');
        }
        return view('auth.resetPassword', ['token' => $token], ['email' => $record->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);
        $record = DB::table('password_resets')->where([
            ['email', $request->email],
            ['token', $request->token]
        ])->first();
        if (!$record) {
            return back()->with('error', 'Invalid token or email.');
        }
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('email', $request->email)->delete();
        return redirect()->route('login')->with('success', 'Password reset successful. Please login.');
    }
}
