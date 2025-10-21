<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }





    public function updateprofile(Request $request)
    {
        $user = Auth::user();

        // Set validation rules based on whether a password is provided
        $rules = [
            'name' => 'required|string|max:255'
        ];

        if ($request['password'] != '') {
            $rules['password'] = 'required';
            $rules['new_password'] = [
                'required',
                'string',
                'min:8',                  // must be at least 8 characters in length
                'regex:/[a-z]/',          // must contain at least one lowercase letter
                'regex:/[A-Z]/',          // must contain at least one uppercase letter
                'regex:/[0-9]/',          // must contain at least one digit
                'regex:/[@$.!%*#?&]/',    // must contain a special character
                'different:password'      // must be different from the current password
            ];
        }

        // Perform validation
        $validation = $request->validate($rules);

        // Only check the password if it's provided
        if ($request['password'] != '') {
            // Check if the provided password is correct
            if (!Hash::check($request['password'], $user->password)) {
                return redirect()->back()->with('error', 'Your current password does not match.');
            }

            // Update the user's password
            $user->password = bcrypt($request['new_password']);
        }

        // Update the user's name
        $user->name = $request['name'];
        $user->save();

        LogActivity::addToLog('Profile Update (' . $user->name . ') by ' . Auth::user()->name);


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
