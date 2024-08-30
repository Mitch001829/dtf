<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    /**
     * Display public registration view
     */
    public function publicReg(): View
    {   
        $set_role = 'guest';
        $form_title = 'User Registration';
        return view('auth.register', compact('set_role', 'form_title'));
    }


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $set_role = 'admin';
        $form_title = 'Admin Registration';
        return view('auth.register', compact('set_role', 'form_title'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string'],
        ]);
        
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole($request->role);
        event(new Registered($user));

        if (Auth::check() == false) {
            Auth::login($user);
        }

        return redirect(route('dashboard', absolute: false));
    }


    
}
