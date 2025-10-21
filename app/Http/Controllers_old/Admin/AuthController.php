<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\LoginCount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function adminlogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->with('error', 'Invalid email or password.');
        }

        // Check if the user status is 1
        if ($user->status != 1) {
            return back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

        // Check if the account is locked out
        if ($user->lockout_time) {
            return back()->with('error', 'Your account has been locked. Please reset your password.');
        }

        // For internal users, check if they need to change their password
        if (is_null($user->password_changed_at)) {
            // Store the user's email in the session to use in the password change flow
            session(['user_email_for_password_change' => $user->email]);

            // Redirect them to the password change page without logging them in
            return redirect(route('password_change'))->with('forcePasswordChange', true);
        }

        if (Hash::check($request->password, $user->password)) {
            // Check if the password needs to be changed due to expiration
            $loginCount = LoginCount::orderby('id', 'DESC')->first();
            if ($user->password_changed_at && now()->diffInDays($user->password_changed_at) >= $loginCount->password_age) {
                session(['user_email_for_password_change' => $user->email]);
                return redirect(route('password_change'))->with('error', 'You must change your password as it has been 30 days since the last update.');
            }

            // Reset failed login attempts on successful login
            $user->failed_logins = 0;
            $user->lockout_time  = null;
            $user->save();

            Auth::login($user);
            LogActivity::addToLog('Login (' . $user->name . ') by ' . Auth::user()->name);

            return redirect()->intended('dashboard');
        } else {
            // Increment failed login attempts
            $user->failed_logins += 1;
            $loginCount = LoginCount::orderby('id', 'DESC')->first();

            if ($user->failed_logins >= $loginCount->login_count) {
                // Lock the account
                $user->lockout_time = now();
                $user->save();
                session(['user_email_for_password_change' => $user->email]);
                return back()->with('error', 'Your account has been locked. Please reset your password.');
            }

            $user->save();
            return back()->with('error', 'Incorrect email or password.');
        }
    }

    public function adminforgetpassword(Request $request)
    {

        //return $request;
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => Carbon::now(),
        ]);

        $user_details = User::where('email', $request->email)->first();

        // email data
        $email_data = [
            'token'     => $token,
            'email'     => $request->email,
            'user_name' => $user_details->name,

        ];

        Mail::send('emails.forgetpassword', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'])
                ->subject('Reset Password')
                ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function adminresetpassword($token)
    {

        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function adminresetpasswordsubmit(Request $request)
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

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        if (! $updatePassword) {
            return back()->withInput()->withErrors('Invalid token!');
        }

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return back()->withInput()->withErrors('User not found.');
        }

        // Check if the new password is in any of the last 10 used passwords
        $loginCount    = LoginCount::orderby('id', 'DESC')->first();
        $pastPasswords = $user->passwordHistories()->latest()->take($loginCount->login_history_count)->pluck('password');
        foreach ($pastPasswords as $pastPassword) {
            if (Hash::check($request->password, $pastPassword)) {
                return back()->withErrors(['password' => 'You cannot reuse your last 10 passwords.']);
            }
        }

        // Update the user's password
        $user->password            = Hash::make($request->password);
        $user->password_changed_at = now();
                                     // Reset lockout info
        $user->lockout_time  = null; // Assuming this is the column to track lockout time
        $user->failed_logins = 0;    // Reset failed login attempt count
        $user->save();

        // Add the new password to the history
        $user->passwordHistories()->create(['password' => $user->password]);

        // Delete the password reset record
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed and any account locks have been cleared.');
    }
}
