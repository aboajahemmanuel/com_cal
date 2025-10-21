<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginCount;
use App\Models\LoginLog;
use App\Models\User;
use App\Models\UsersPending;
use App\Services\CustomLogger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // public function adminlogin(Request $request)
    // {
    //     CustomLogger::logAction('Admin Login Attempt', 'Initiated', ['email' => $request->email]);

    //     $this->validate($request, [
    //         'email'    => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     // Fetch the latest pending user record
    //      $user_pending = UsersPending::where('user_id', $user->id)->orderby('id', 'DESC')->first();

    //     // // Check if $user_pending is null before accessing its properties
    //     if ($user_pending && $user_pending->action_type === 'Disabled' && $user_pending->status == 4) {
    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - Account not active', ['email' => $request->email]);
    //         //$this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Account not active', $user->email);
    //         return back()->with('error', 'Your account is not active. Please contact the administrator.');
    //     }

    //     if ($user_pending && $user_pending->action_type === 'Enable' && $user_pending->status == 0) {
    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - Account not active', ['email' => $request->email]);
    //         return back()->with('error', 'Your account is not active. Please contact the administrator.');
    //     }

    //     if (! $user) {
    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - User Not Found', ['email' => $request->email]);
    //         return back()->with('error', 'Invalid email or password.');
    //     }

    //     if ($user->status != 1) {
    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - Inactive Account', ['user_id' => $user->id]);
    //         return back()->with('error', 'Your account is not active. Please contact the administrator.');
    //     }

    //     // Check if user is currently locked out (optional: 15-minute lockout)
    //     if ($user->lockout_time && now()->diffInMinutes($user->lockout_time) < 15) {
    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - Locked Out', ['user_id' => $user->id]);
    //         return back()->with('error', 'Your account is locked. Please try again after 15 minutes or reset your password.');
    //     }

    //     if (Hash::check($request->password, $user->password)) {
    //         // Reset failed logins and lockout
    //         $user->failed_logins = 0;
    //         $user->lockout_time  = null;
    //         $user->save();

    //         Auth::login($user);

    //         CustomLogger::logAction('Admin Login', 'Success', ['user_id' => $user->id]);
    //         return redirect()->intended('dashboard');
    //     }

    //     // Password is incorrect
    //     $user->failed_logins += 1;
    //     $loginCount = LoginCount::latest()->first();

    //     if ($user->failed_logins >= $loginCount->login_count) {
    //         $user->lockout_time = now();
    //         $user->save();

    //         CustomLogger::logAction('Admin Login Attempt', 'Failed - Account Locked', ['user_id' => $user->id]);
    //         return back()->with('error', 'Your account has been locked. Please reset your password.');
    //     }

    //     $user->save();

    //     CustomLogger::logAction('Admin Login Attempt', 'Failed - Incorrect Password', ['user_id' => $user->id]);

    //     return back()->with('error', 'Incorrect email or password.');
    // }

    public function adminlogin(Request $request)
    {
        // Validate email and password fields
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Capture the IP address for logging purposes
        $ipAddress = $request->ip();

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // If the user doesn't exist, log the failed attempt and return an error
        if (! $user) {
            $this->logLoginAttempt(
                null,
                'failed',
                $ipAddress,
                'Invalid email or password',
                $request->email
            );
            return back()->with('error', 'Invalid email or password.');
        }

        // Fetch the latest pending user record
        $user_pending = UsersPending::where('user_id', $user->id)->orderby('id', 'DESC')->first();

        // Check if $user_pending is null before accessing its properties
        if ($user_pending && $user_pending->action_type === 'Disabled' && $user_pending->status == 4) {
            $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Account not active', $user->email);
            return back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

        if ($user_pending && $user_pending->action_type === 'Enable' && $user_pending->status == 0) {
            $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Account not active', $user->email);
            return back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

        // Check if the user's account is locked out
        if ($user->lockout_time) {
            $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Account locked', $user->email);
            return back()->with('error', 'Your account has been locked. Please reset your password.');
        }

        // Verify the password
        if (Hash::check($request->password, $user->password)) {
            // Check if it's an external user and their email is not verified
            if ($user->usertype === 'external' && $user->email_verified_at === null) {
                $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Email not verified', $user->email);
                return redirect(route('login'))->with('error', 'Please verify your email to continue');
            }

            // For internal users, check if they need to change their password
            if ($user->usertype === 'internal' && is_null($user->password_changed_at)) {
                session(['user_email_for_password_change' => $user->email]);
                return redirect(route('password_change'))->with('forcePasswordChange', true);
            }

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

            // Log the successful login attempt
            $this->logLoginAttempt($user->id, 'success', $ipAddress, 'Login successful', $user->email);

            // Log the user in and redirect based on user type
            Auth::login($user);
            $redirectRoute = $user->usertype === 'internal' ? 'dashboard' : 'home';
            return redirect(route($redirectRoute));
        } else {
            // Increment failed login attempts and check for lockout
            $user->failed_logins += 1;
            $loginCount = LoginCount::orderby('id', 'DESC')->first();

            if ($user->failed_logins >= $loginCount->login_count) {
                $user->lockout_time = now();
                $user->save();
                $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Account locked due to failed attempts', $user->email);
                return back()->with('error', 'Your account has been locked. Please reset your password.');
            }

            // Save the user with the incremented failed logins and log the failed attempt
            $user->save();
            $this->logLoginAttempt($user->id, 'failed', $ipAddress, 'Incorrect email or password', $user->email);
            return back()->with('error', 'Incorrect email or password.');
        }
    }

    protected function logLoginAttempt($userId = null, $status, $ipAddress, $message = null, $email = null)
    {
        LoginLog::create([
            'user_id'    => $userId,
            'name'       => $userId ? User::find($userId)->name : null,
            'email'      => $email, // Log the email even if the user is not found
            'status'     => $status,
            'ip_address' => $ipAddress,
            'message'    => $message,
        ]);
    }

    public function adminforgetpassword(Request $request)
    {
        CustomLogger::logAction('Password Reset Request', 'Initiated', ['email' => $request->email]);

        $request->validate([
            'email' => 'required|email',
        ]);

        $user_details = User::where('email', $request->email)->first();

        if (! $user_details) {
            CustomLogger::logAction('Admin Reset Password  Attempt', 'Failed - User Not Found', ['email' => $request->email]);
            return back()->with('message', 'Invalid email or password.');
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => Carbon::now(),
        ]);

        // Email data
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

        CustomLogger::logAction('Password Reset Request', 'Email Sent', ['email' => $request->email]);

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function adminresetpassword($token)
    {

        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function adminresetpasswordsubmit(Request $request)
    {
        CustomLogger::logAction('Password Reset Attempt', 'Initiated', ['email' => $request->email]);

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
            CustomLogger::logAction('Password Reset Attempt', 'Failed - Invalid Token', ['email' => $request->email]);
            return back()->withInput()->withErrors('Invalid token!');
        }

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            CustomLogger::logAction('Password Reset Attempt', 'Failed - User Not Found', ['email' => $request->email]);
            return back()->withInput()->withErrors('User not found.');
        }

        // Check if the new password is in any of the last 10 used passwords
        $loginCount    = LoginCount::orderby('id', 'DESC')->first();
        $pastPasswords = $user->passwordHistories()->latest()->take($loginCount->login_history_count)->pluck('password');
        foreach ($pastPasswords as $pastPassword) {
            if (Hash::check($request->password, $pastPassword)) {
                CustomLogger::logAction('Password Reset Attempt', 'Failed - Reused Password', ['user_id' => $user->id]);
                return back()->withErrors(['password' => 'You cannot reuse your last 10 passwords.']);
            }
        }

        // Update the user's password
        $user->password            = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->lockout_time        = null;
        $user->failed_logins       = 0;
        $user->save();

        // Add the new password to the history
        $user->passwordHistories()->create(['password' => $user->password]);

        // Delete the password reset record
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        CustomLogger::logAction('Password Reset', 'Success', ['user_id' => $user->id]);

        return redirect('/login')->with('success', 'Your password has been changed and any account locks have been cleared.');
    }
}
