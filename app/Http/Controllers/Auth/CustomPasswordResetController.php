<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomPasswordResetController extends Controller
{
    private const OTP_EXPIRY_MINUTES = 5;

    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function sendOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please enter a valid email address.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->input('email')));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'We could not find an account with this email.',
            ], 404);
        }

        $otp = Str::random(6);
        $expiresAt = now()->addMinutes(self::OTP_EXPIRY_MINUTES);

        session([
            'password_reset_otp_email' => $email,
            'password_reset_otp_hash' => Hash::make($otp),
            'password_reset_otp_expires_at' => $expiresAt->timestamp,
            'password_reset_otp_verified' => false,
        ]);

        try {
            Mail::raw(
                "Your ShamPro password reset code is: {$otp}\n\nThis code will expire in " . self::OTP_EXPIRY_MINUTES . " minutes.",
                function ($message) use ($email) {
                    $message->to($email)->subject('ShamPro Password Reset OTP');
                }
            );
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Unable to send OTP email right now. Please check your mail configuration.',
            ], 500);
        }

        return response()->json([
            'message' => 'OTP has been sent to your email.',
            'email' => $email,
            'expires_in' => self::OTP_EXPIRY_MINUTES * 60,
        ]);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid OTP payload.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->input('email')));
        $otp = trim($request->input('otp'));

        $sessionEmail = session('password_reset_otp_email');
        $sessionHash = session('password_reset_otp_hash');
        $sessionExpiry = (int) session('password_reset_otp_expires_at', 0);

        if (!$sessionEmail || !$sessionHash || !$sessionExpiry || $sessionEmail !== $email) {
            return response()->json([
                'message' => 'OTP session expired. Please request a new code.',
            ], 422);
        }

        if (now()->timestamp > $sessionExpiry) {
            session()->forget([
                'password_reset_otp_email',
                'password_reset_otp_hash',
                'password_reset_otp_expires_at',
                'password_reset_otp_verified',
            ]);

            return response()->json([
                'message' => 'OTP expired. Please request a new code.',
            ], 422);
        }

        if (!Hash::check($otp, $sessionHash)) {
            return response()->json([
                'message' => 'Incorrect OTP code.',
            ], 422);
        }

        session([
            'password_reset_otp_verified' => true,
            'password_reset_verified_email' => $email,
        ]);

        return response()->json([
            'message' => 'OTP verified successfully.',
            'redirect' => route('password.custom.reset-form'),
        ]);
    }

    public function showResetPasswordForm()
    {
        if (!session('password_reset_otp_verified') || !session('password_reset_verified_email')) {
            return redirect()->route('password.custom.forgot')
                ->withErrors(['email' => 'Please verify OTP first.']);
        }

        return view('auth.passwords.reset', [
            'verifiedEmail' => session('password_reset_verified_email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        if (!session('password_reset_otp_verified') || !session('password_reset_verified_email')) {
            return redirect()->route('password.custom.forgot')
                ->withErrors(['email' => 'Session expired. Please verify OTP again.']);
        }

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = session('password_reset_verified_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.custom.forgot')
                ->withErrors(['email' => 'Account not found.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        session()->forget([
            'password_reset_otp_email',
            'password_reset_otp_hash',
            'password_reset_otp_expires_at',
            'password_reset_otp_verified',
            'password_reset_verified_email',
        ]);

        return redirect()->route('login')->with('status', 'Password updated successfully. Please sign in.');
    }
}
