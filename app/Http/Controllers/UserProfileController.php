<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function edit()
    {
        $authenticatedUser = Auth::user();

        $userInfo = Employee::where('user_id', $authenticatedUser->id)
            ->select('id', 'id_no', 'fname', 'mname', 'lname', 'emp_type', 'address', 'profile_photo_path')
            ->first();

        $credentials = User::where('id', $authenticatedUser->id)
            ->select('id', 'username')
            ->first();

        return inertia('CustomProfile/Edit', [
            'userInfo' => $userInfo,
            'credentials' => $credentials
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,jpg,png|max:2048',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
        ]);

        $attributes = [
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
        ];

        if($request->photo) {
            $filename = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/profile_pictures'), $filename);
            $attributes['profile_photo_path'] = $filename;
        }

        $user = User::where('id', auth()->user()->id)->first();

        $user->employee()->update($attributes);

        return back()->with('success', 'Your profile information has been updated!');
    }

    public function deletePhoto()
    {
        $emp = Employee::where('user_id', auth()->user()->id)->first();

        $emp->update(['profile_photo_path' => null]);

        return back()->with('success', 'Your profile photo has been deleted.');
    }
}
