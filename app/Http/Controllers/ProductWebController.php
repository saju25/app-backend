<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index()
    {
        return view('user.productStoreForm');
    }
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
                    $file = $request->file('product_photo');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    // Move the file to the public folder (within 'uploads/products')
                    $file->move(public_path('uploads/products'), $fileName);
                    
                    // Store only the relative path in the database
                    $product->product_photo = 'uploads/products/' . $fileName;
                }


            // Save the product
            $product->save();

            return response()->json(['product' => $product]);
        } else {
            // If no shop is found for the user, return an error
            return back()->with('error', 'No shop found for this user. Please create a shop first.');
        }
    }
    public function editview($id)
    {
        $product = Product::find($id);
        return view('user.product-update', ['product' => $product]);
    }


    public function update(Request $request, $id)
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

    // If the shop is found, proceed with updating the product
    if ($shop) {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Check if the product belongs to the authenticated user's shop
        if ($product->shop_id != $shop->id) {
            return back()->with('error', 'You are not authorized to update this product.');
        }

        // Update the product details
        $product->update($request->except('product_photo'));  // Update all except the photo

        // Handle file upload for product photo if there is a new file
        if ($request->hasFile('product_photo')) {
            // Delete the old product photo if it exists
            if ($product->product_photo && file_exists(public_path($product->product_photo))) {
                unlink(public_path($product->product_photo));  // Delete old image
            }

            // Handle the new photo upload
            $file = $request->file('product_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $fileName);
            
            // Store the relative path in the database
            $product->product_photo = 'uploads/products/' . $fileName;

            // Save the product again with the updated photo
            $product->save();
        }

       return redirect()->route('shop.index')->with('success', 'Product updated successfully.');
    } else {
        // If no shop is found for the user, return an error
        return back()->with('error', 'No shop found for this user. Please create a shop first.');
    }
}

}
