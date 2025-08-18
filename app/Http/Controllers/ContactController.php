<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
   
    public function sendMail(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw(
            "New message from {$request->name} ({$request->email})\n\n" .
            "Subject: {$request->subject}\n\n" .
            "Message:\n{$request->message}",
            function ($msg) use ($request) {
                $msg->to('admin@example.com')
                    ->subject('Contact Form: ' . ($request->subject ?? 'No Subject'));
            }
        );

        return back()->with('mail-success', 'Message sent successful!');
    }
}
