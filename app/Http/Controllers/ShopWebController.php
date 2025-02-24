<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopWebController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shop = Shop::where('user_id', $user->id)->first();
      
        
        if($shop) {
            $products = Product::where('shop_id', $shop->id)->get();
            return view('user.shop', ['products' => $products]);
        } else {
            return view('user.shopadd');
        }
    }
    public function shopinfo(){
        $user = Auth::user();
        $shop = Shop::where('user_id', $user->id)->first();
      
      return view('user.shop-info', ['shop' => $shop]);
     
    }




    public function update(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_description' => 'nullable|string',
            'shop_address' => 'required|string|max:255',
            'shop_phone' => 'nullable|string|max:20',
            'shop_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // image validation
            'shop_email' => 'nullable|email|max:255',
        ]);
    
        // Find the shop by ID
        $user = Auth::user();
        $shop = Shop::where('user_id', $user->id)->first();
        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please provide a valid token.',
            ], 401);
        }
    
        // Handle file upload for shop_photo (only if a new photo is uploaded)
        $filePath = $shop->shop_photo;  // Default to the current photo path if no new file is uploaded
        if ($request->hasFile('shop_photo')) {
            // Delete old file if it exists
            if ($shop->shop_photo && file_exists(public_path($shop->shop_photo))) {
                unlink(public_path($shop->shop_photo));
            }
    
            // Handle the new file upload
            $file = $request->file('shop_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/shops'), $fileName);
    
            // Update the file path
            $filePath = 'uploads/shops/' . $fileName;
        }
    
        // Update the shop record in the database
        $shop->update([
            'shop_name' => $request->shop_name,
            'shop_description' => $request->shop_description,
            'shop_address' => $request->shop_address,
            'shop_phone' => $request->shop_phone,
            'shop_photo' => $filePath,  // Use the new or existing photo path
            'shop_email' => $request->shop_email,
            'user_id' => $user->id,  // Keep the same user ID
        ]);
    
        // Return success response with the updated shop data
        return response()->json([
            'success' => true,
            'message' => 'Shop updated successfully!',
            'data' => $shop,  // Optionally include the updated shop data in the response
        ]);
    }
    




    public function order()
    {
        $user = Auth::user();
        $shop = Shop::where('user_id', $user->id)->first();
        $orders = Order::where('shop_id', $shop->id)->get();
         return view('user.shop-order', ['orders' => $orders]);
       
    }
 
    
}
