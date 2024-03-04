<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;

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
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $user = User::create($validatedData);

        $user->assignRole('visitor');

        event(new Registered($user));

        session()->flash('success', 'Registration successful! Please check your email for verification.');

        return redirect('/login');
    }
}
