<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Custom validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // password_confirmation field required for matching
        ]);

        if ($validator->fails()) {
            // Return validation errors
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validToken = rand(10, 100. . '2024');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
            'otp_code' => $validToken,
            'is_verified' => false,
        ]);

        $get_user_email = $request->email;
        $get_user_name = $request->fullname;
        Mail::to($request->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));


        // Generate a token for the user using Sanctum
        $token = $user->createToken('MyAppToken')->plainTextToken;

        // Return the response with the user and token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function otpVerification(Request $request, $id)
    {
      
    
       $user = User::find($id);

      if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        if ((string)$user->otp_code === (string)$request->otp_code) {
            $user->is_verified = 1;
            $user->otp_code = null;  
            $user->expo_push_token = $request->expo_push_token;  
            $user->email_verified_at = now(); 
            $user->save();
          
    
            
            $token = $user->createToken('MyAppToken')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json(['message' => 'OTP does not match'], 400);
        }
    }


    public function resendOtp($id)
    {
        $user = User::query()->where('id', $id)->first();
        $validToken = rand(10, 100. . '2024');
        $user->otp_code = $validToken;
        $user->save();
        $get_user_email = $user->email;
        $get_user_name = $user->fullname;
        Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

        return redirect()->back();
    }
    public function resendOtpInemail($email)
    {
        $user = User::query()->where('email', $email)->first();
        $validToken = rand(10, 100. . '2024');
        $user->otp_code = $validToken;
        $user->save();
        $get_user_email = $user->email;
        $get_user_name = $user->fullname;
        Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

        return response()->json(['user' => $user]);
    }
    public function passwordChange(Request $request,$id)
    {
         $user = User::find($id);
 
       if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }
     
         if ((string)$user->otp_code === (string)$request->otp_code) {
             $user->is_verified = 1;
             $user->otp_code = null;  
             $user->expo_push_token = $request->expo_push_token;  
             $user->email_verified_at = now(); 
             $user->password = Hash::make($request->password); 
             $user->save();
             $token = $user->createToken('MyAppToken')->plainTextToken;
             return response()->json([
                 'token' => $token,
                 'user' => $user,
             ], 200);
         } else {
             return response()->json(['message' => 'OTP does not match'], 400);
         }
     }



}
