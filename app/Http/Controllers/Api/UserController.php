<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dm;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUserData()
    {
        $user = Auth::user();
        return response()->json([
                    'user' => $user,
                ]);
    }


    public function getUserOrder($id)
    {
        $user = Auth::user();
    
        // // Generate a unique ID (UUID)
        $uniqueId = Str::uuid();
    
        // Find the order by ID
        $order = Order::find($id);
    
        // Check if the order exists
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        // Assign the unique payment ID to the order
        $order->paymentid = $uniqueId;
    
        // Save the order with the new payment ID
        $order->save();
    
        // Return the user, unique ID, and updated order
        return response()->json([
            'user' => $user,
            'unique_id' => $uniqueId,
             'order' => $order,
        ]);
    }


    public function shopUser($id)
    {
        // Fetch the shop by its ID
        $shop = Shop::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $shop->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }
    public function driverUser($id)
    {
        // Fetch the shop by its ID
        $dm = Dm::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $dm->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }
    public function orderUser($id)
    {
        // Fetch the shop by its ID
        $order = Order::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $order->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }
    
}
