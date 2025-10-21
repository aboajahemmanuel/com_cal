<?php
namespace App\Http\Controllers;

use App\Models\LoginCount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChnageController extends Controller
{
    public function showChangePasswordForm()
    {
        $email = session('user_email_for_password_change');
        if (! $email) {
            return redirect('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        return view('auth.passwords.change', compact('email'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password'              => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@.$!%*#?&]/',
            ],
            'password_confirmation' => 'required',
        ], [
            'password.required'              => 'The password field is required.',
            'password.string'                => 'The password must be a string.',
            'password.confirmed'             => 'The passwords do not match.',
            'password.min'                   => 'The password must be at least 8 characters.',
            'password.regex'                 => 'The password must include uppercase, lowercase, numeric, and special characters.',
            'password_confirmation.required' => 'Please confirm your password.',
        ]);

        $email = session('user_email_for_password_change');
        if (! $email) {
            return redirect('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        $user = User::where('email', $email)->first();
        if (! $user) {
            return redirect('login')->withErrors(['error' => 'User not found.']);
        }

        // Check if the new password is in any of the last 10 used passwords
        $loginCount    = LoginCount::orderby('id', 'DESC')->first();
        $pastPasswords = $user->passwordHistories()->latest()->take($loginCount->login_history_count)->pluck('password');
        foreach ($pastPasswords as $pastPassword) {
            if (Hash::check($request->password, $pastPassword)) {
                return back()->withErrors(['password' => 'You cannot reuse your last 10 passwords.']);
            }
        }

        $user->password            = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();

        session()->forget('user_email_for_password_change');

        Auth::login($user); // Optionally log the user in automatically

        return redirect()->route('dashboard')->with('success', 'Password changed successfully.');

        // // Log the user out
        // Auth::logout();

        // // Redirect with success message
        // return redirect('/login')->with('success', 'Your password has been changed successfully. Please log in with your new password.');
    }
}
