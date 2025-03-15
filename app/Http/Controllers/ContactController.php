<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::to('support@willbesent.com')->send(new ContactMail($validatedData));

        return response()->json(['success' => true]);
    }
}
