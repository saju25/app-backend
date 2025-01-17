<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopApprovedController extends Controller
{
    public function getShopData()
{
    $user = Auth::user(); // Get the authenticated user
    
    // Check if the user exists
    if (!$user) {
        return response()->json(['message' => 'User not authenticated'], 401);
    }
    
    // Get shop data based on user_id
    $shop = Shop::where('user_id', $user->id)->first();
    
    // If no shop data, return a meaningful message
    if (!$shop) {
        return response()->json(['message' => 'No shop data found'], 404);
    }

    // Return the shop data
    return response()->json(['shop' => $shop]);
}

    public function getShop()
    {
         $shop = Shop::all();
        if ($shop->isEmpty()) {
            return response()->json(['message' => 'No shop data found'], 404);
        }
         return response()->json(['shop' => $shop]);
    }
    public function getProduct($id)
    {
        // Query to fetch the product by shop_id
        $product = Product::where('shop_id', $id)->get();
    
        // If the product is empty, return a 404 response
        if ($product->isEmpty()) {
            return response()->json(['message' => 'No shop data found'], 404);
        }
    
        // Return the product data if found
        return response()->json(['product' => $product]);
    }
    
    
}

