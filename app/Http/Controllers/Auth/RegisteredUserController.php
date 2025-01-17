<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $validToken = rand(10, 100. . '2024');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp_code' => $validToken,
            'is_verified' => false,
        ]);

        $user->save();

        $get_user_email = $request->email;
        $get_user_name = $request->fullname;
        Mail::to($request->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

        return redirect('/verify-otp/' . $user->id);
    }

    
  
    public function verifyOtpByUser(Request $request, $id)
    {
        $user = User::query()->where('id', $id)->first();
        return view('otp_verification', compact('user'));

    }



    public function useractivation(Request $request)
    {

        $userId = intval($request->user);
        $user = User::where('id', $userId)->first();

        if ($user->otp_code == $request->token) {
            $user->is_verified = 1;
            $user->otp_code = null;
            $user->email_verified_at = now();
            $user->save();
            Auth::login($user);
            return redirect()->to('/');
        } else {
            return redirect('/verify-otp/' . $user->id);
        }
    }



    public function resendOtp($id)
    {
        $user = User::query()->where('id', $id)->first();
        $validToken = rand(10, 100. . '2024');
        $user->otp_code = $validToken;
        $user->save();

        // Resend OTP
        $get_user_email = $user->email;
        $get_user_name = $user->fullname;
        Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

        return redirect()->back();
    }


}
