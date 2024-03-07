<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Login Page | BKA Blog'
        ]); // Replace 'auth.login' with the actual name of your custom login view
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email:dns', 'password' => 'required']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Auth::user()->activity()->update(['is_logged_out' => 0]);
            return redirect()->intended('/dashboard'); // Replace '/dashboard' with the actual URL of your dashboard route
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        $userId = auth()->id();
        if ($userId) {
            Cache::forget('user_' . $userId . '_online');
        }



        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register | BKA Blog',
            'location' => 'register',
            'description' => 'Register Now'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,username|alpha_dash',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => ['required', Password::min(6)->letters()->mixedCase()->numbers()]
        ]);

        if ($request->has('password_confirmation')) {
            $request->validate(['password_confirmation' => 'required|same:password']);
        }


        $user = User::create($validatedData);

        $user->assignRole('visitor');

        event(new Registered($user));

        session()->flash('successRegister', 'Registration successful! Please check your email for verification.');

        return redirect('/login');
    }
}
