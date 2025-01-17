<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Remove the expo_push_token (Optional)
        $user->expo_push_token = null;
        $user->save();

        // Revoke all tokens issued to the user
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        // Return a success response
        return response()->json(['message' => 'Logged out successfully.'], 200);
    }
}
