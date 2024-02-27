<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return inertia('ChangePassword/Edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // check if current password matches the actual current password
        if(!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'current_password' => 'Your current password is incorrect.'
            ]);
        }

        $user = User::where('id', auth()->user()->id)->first();

        $user->update(['password' => bcrypt($request->new_password)]);

        return back()->with('success', 'Your password has been changed successfully!');
    }
}
