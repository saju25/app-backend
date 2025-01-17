<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddToCart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    /**
     * Store a new item in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     */
public function index(Request $request)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retrieve the cart items for the authenticated user
        $cartItems = AddToCart::where('user_id', $user->id)->get();

        // Return the cart items in JSON format
        return response()->json([
            'message' => 'Cart items retrieved successfully',
            'data' => $cartItems,
        ], 200);
    }


 public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'shop_id' => 'required',
            'quantity' => 'required|integer|min:1',
       ]);
    
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        // Create a new cart item with the user_id included
        $cartItem = AddToCart::create([
            'product_id' => $request->input('product_id'),
            'shop_id' => $request->input('shop_id'),
            'quantity' => $request->input('quantity'),
            'piece_strip_pack' => $request->input('piece_strip_pack'),
            'user_id' => $user->id, // Ensure this line is added to include the authenticated user's ID
        ]);
    
        return response()->json([
            'message' => 'Item added to cart successfully',
            'data' => $cartItem,
        ], 201);
    }
    

 public function update(Request $request, $id)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        // Find the cart item by ID and ensure it belongs to the authenticated user
        $cartItem = AddToCart::where('product_id', $id)->where('user_id', $user->id)->first();
    
        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found or unauthorized'], 404);
        }
    
        // Update only the fields that are present in the request
        $updateData = [];
        if ($request->has('product_id')) {
            $updateData['product_id'] = $request->input('product_id');
        }
        if ($request->has('shop_id')) {
            $updateData['shop_id'] = $request->input('shop_id');
        }
        if ($request->has('quantity')) {
            $updateData['quantity'] = $request->input('quantity');
        }
        if ($request->has('piece_strip_pack')) {
            $updateData['piece_strip_pack'] = $request->input('piece_strip_pack');
        }
      
    
        // If there is data to update, proceed with the update
        if (!empty($updateData)) {
            $cartItem->update($updateData);
        }
    
        return response()->json([
            'message' => 'Cart item updated successfully',
            'data' => $cartItem,
        ], 200);
    }
    
    
    
public function destroy(Request $request, $id)
    {
    // Check if the user is authenticated
    $user = Auth::user();
    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Find the cart item by ID and ensure it belongs to the authenticated user
    $cartItem = AddToCart::where('id', $id)->where('user_id', $user->id)->first();

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found or not owned by the user'], 404);
    }

    // Delete the cart item
    $cartItem->delete();

    return response()->json(['message' => 'Item removed from cart successfully'], 200);
}





}
