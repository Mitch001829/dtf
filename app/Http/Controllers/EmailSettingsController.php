<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\StandardMail;



class EmailSettingsController extends Controller
{
    public function index()
    {
        return view('pages.settings.email.index');
    }


    public function test(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $subject = "Test Email";
        $message = "Test Emai";

        $data = array(
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        );

        Mail::to($validated['email'])->send(new StandardMail($data));

        return redirect()->back()->with("success", "Email sent successfully");
    }
}
