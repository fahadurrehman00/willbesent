<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\WelcomeEmail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
        ]);

        // Create the user
        $user = User::create([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,  // Corrected field from email to lastName
            'phone' => '+1' . $request->phone,  // Added phone field
            'state' => $request->state,  // Added state field
            'pincode' => $request->pincode,
            'zip' => $request->zip,  // Added zip field
            'street' => $request->street,  // Added street field
            'city' => $request->city,  // Added city field
            'frequency' => $request->frequency,  // Added frequency field
            'email' => $request->email,
            'message_time' => $request->message_time,
            'password' => Hash::make($request->password),  // Hashing the password
        ]);

        event(new Registered($user));

        Mail::to($user->email)->send(new WelcomeEmail($user));
        Mail::to("willbesent@arvoequities.com")->send(new WelcomeEmail($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
