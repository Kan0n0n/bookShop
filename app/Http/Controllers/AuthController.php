<?php

namespace App\Http\Controllers;

use App\Models\CustomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function signInFoward(Request $request)
    {
        if ($request->isMethod("post")) {
            Log::info("Sign in request: ", ["email" => $request->email, "password" => $request->password]);

            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            Log::info('SignIn request validated', ['email' => $request->email]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                Log::info('Auth Complete', ['email' => $request->email]);
                return redirect()->route('index')->with('success', 'Login successful');
            }

            Log::warning('Log Error', ['email' => $request->email]);
            return back()->with('error', 'Email or password is incorrect');
        }

        return view("auth.signin");
    }

    public function signUpFoward(Request $request)
    {
        if ($request->isMethod("post")) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:custom_users',
                'password' => 'required|string|min:8|confirmed',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|min:10|max:10',
                'gerne' => 'required|string|in:male,female,other',
            ]);

            $user = CustomUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'gerne' => $request->gerne,
            ]);

            event(new Registered($user));

            Auth::login($user);
            return redirect()->route('index')->with('success', 'Registration successful');
        }

        return view("auth.signup");
    }

    public function signOutFoward(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Logout successful');
    }
}
