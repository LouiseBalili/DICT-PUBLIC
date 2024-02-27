<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function loginForm()
    {
        $logoPath = asset('images/Logo.png');

        return inertia('CustomAuth/Login', [
            'logoPath' => $logoPath,
        ]);
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // public function authenticate(Request $request)
    // {
        
    //     $credentials = $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if(Auth::attempt($credentials)) {
    //         // $user = User::where('id', Auth::user()->id)->first();

    //         // dd($user);
    //     } else {
    //         return back()->withErrors([
    //             'username' => 'These credentials do not match our records.'
    //         ]);
    //     }   
    // }

    // public function logout()
    // {
    //     Auth::logout();

    //     return redirect('/login')->with('success', 'You have been logged out!');
    // }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
