<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;


class MailController extends Controller
{
    public function showForm()
    {
        return view('send-email');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $details = [
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to($details['email'])->send(new SendEmail($details));

        return redirect()->back()->with('message', 'Email sent successfully!');
    }
}