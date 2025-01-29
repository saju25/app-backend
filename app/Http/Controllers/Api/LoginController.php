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


    public function login(Request $request)
    {
       
       try {
          
         $user = User::where('email', $request->email)->first();
         
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
          if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
    
            if ($user->is_verified !== 1) {
                return response()->json([
                    'message' => 'User is not verified',
                    'user' => $user
                ], 200);
            }
    
            
            $user->expo_push_token = $request->expoPushToken;
            $user->save();
            $token = $user->createToken('MyAppToken')->plainTextToken;
    
            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
  
        } catch (\Exception $e) {
             \Log::error('Login error: ' . $e->getMessage());
           return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
    }
    



}
