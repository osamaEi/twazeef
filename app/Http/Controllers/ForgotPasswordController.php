<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'email.exists' => __('auth.email_not_found'),
        ]);

        $email = $request->email;
        $token = Str::random(64);

        // Store the reset token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Send the reset email
        try {
            Mail::to($email)->send(new ResetPasswordMail($token, $email));

            return back()->with('status', __('auth.password_reset_link_sent'));
        } catch (\Exception $e) {
            // Remove the token if email fails
            DB::table('password_resets')->where('email', $email)->delete();

            return back()->withErrors(['email' => __('auth.password_reset_link_failed')]);
        }
    }
}
