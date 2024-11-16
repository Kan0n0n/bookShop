<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Intervention\Image\Facades\Image;

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
            Log::info('sign up request: ', $request->all());

            $request->validate([
                'avatar_path'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'date_of_birth' => 'required|date',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|min:10|max:10',
                'gerne' => 'required|string|in:male,female,other',
            ]);

            Log::info('Validation passed');

            $avatarPath = 'images/avatarUpload/default-avatar.jpg';

            if ($request->hasFile('avatar_path')) {
                $file = $request->file('avatar_path');
                $imgPath = 'images/avatarUpload/';
                $imgName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($imgPath), $imgName);
                $avatarPath = $imgPath . $imgName;
                Log::info('Avatar file moved', ['avatarPath' => $avatarPath]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'gerne' => $request->gerne,
                'date_of_birth' => $request->date_of_birth,
                'avatar_path' => $avatarPath,
            ]);

            Log::info('User created', ['user' => $user]);

            event(new Registered($user));
            Log::info('Registered event fired');

            Auth::login($user);
            Log::info('User logged in');

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