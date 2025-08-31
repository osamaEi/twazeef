<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        // Check if token exists and is valid
        $resetRecord = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$resetRecord) {
            return redirect()->route('password.request')
                ->withErrors(['email' => __('auth.password_reset_token_invalid')]);
        }

        // Check if token is expired (24 hours)
        if (Carbon::parse($resetRecord->created_at)->addHours(24)->isPast()) {
            DB::table('password_resets')->where('email', $email)->delete();
            return redirect()->route('password.request')
                ->withErrors(['email' => __('auth.password_reset_token_expired')]);
        }

        return view('auth.reset-password', compact('token', 'email'));
    }

    /**
     * Reset the user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => __('auth.token_required'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.confirmed' => __('auth.password_confirmed'),
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        // Verify token
        $resetRecord = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => __('auth.password_reset_token_invalid')]);
        }

        // Check if token is expired
        if (Carbon::parse($resetRecord->created_at)->addHours(24)->isPast()) {
            DB::table('password_resets')->where('email', $email)->delete();
            return back()->withErrors(['email' => __('auth.password_reset_token_expired')]);
        }

        // Update user password
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($password)
            ]);

            // Delete the reset token
            DB::table('password_resets')->where('email', $email)->delete();

            return redirect()->route('login')
                ->with('status', __('auth.password_reset_success'));
        }

        return back()->withErrors(['email' => __('auth.user_not_found')]);
    }
}
