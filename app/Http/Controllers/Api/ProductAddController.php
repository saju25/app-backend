<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductAddController extends Controller
{
    public function formShow()
    {
         return view('user.productStoreForm',);
    }
    public function create()
    {
        $shops = Shop::all();  // Get all shops to populate the shop dropdown
        return view('products.create', compact('shops'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'product_brand_name' => 'required|string|max:255',
            'mrp_price_of_piece' => 'required|numeric',
            'best_price_of_piece' => 'required|numeric',
            'Num_of_piece_one_strip' => 'required|string|max:255',
            'Num_of_strip_one_pack' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'product_photo' => 'nullable|image|max:2048',
        ]);
    
        // Get the shop of the authenticated user
        $shop = auth()->user()->shop;
    
        // If the shop is found, proceed with storing the product
        if ($shop) {
            $product = new Product($request->all());
    
            // Automatically set the shop_id to the authenticated user's shop_id
            $product->shop_id = $shop->id;
    
            // Handle file upload for product photo if any
            if ($request->hasFile('product_photo')) {
                $product->product_photo = $request->file('product_photo')->store('products', 'public');
            }
    
            // Save the product
            $product->save();

            return response()->json(['product' => $product]);
        } else {
            // If no shop is found for the user, return an error
            return back()->with('error', 'No shop found for this user. Please create a shop first.');
        }
    }
    public function getProduct()
    {
        // Query to fetch the product by shop_id
        $product = Product::all();
    
        // If the product is empty, return a 404 response
        if ($product->isEmpty()) {
            return response()->json(['message' => 'No shop data found'], 404);
        }
    
        // Return the product data if found
        return response()->json(['product' => $product]);
    }
    
}
