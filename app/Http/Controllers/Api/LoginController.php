<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Find the user by email
        $user = User::where('email', $request->email)->first();


   
          
                 if (!$user || !Hash::check($request->password, $user->password)) {
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }
            
                // Check if user exists and password matches
                if ($user || Hash::check($request->password, $user->password)) {
                   
                    if ($user->is_verified === 1) {
                       $user->expo_push_token = $request->expoPushToken;
                        $user->save();
                        Auth::login($user);
                      $token = $user->createToken('MyAppToken')->plainTextToken;
            
                        return response()->json([
                            'user' => $user,
                            'token' => $token,
                        ], 200);
                    } else {
                        return response()->json([
                            'user' => $user,
                            'massege' => "unverified",
                        ], 200);
            
                    }
                }
            
                
     


    
    }
}
