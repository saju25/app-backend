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
    
        $uniqueId = Str::uuid();
    
        $order = Order::find($id);
    
       if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $order->paymentid = $uniqueId;
    
        $order->save();
    
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
