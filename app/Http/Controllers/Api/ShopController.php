<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function formShow()
    {
         return view('user.shopadd',);
    }
    public function store(Request $request)
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

        // Get the authenticated user based on the Bearer token
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please provide a valid token.',
            ], 401);
        }

        // Check if a user is authenticated
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please provide a valid token.',
            ], 401); // Unauthorized response
        }

                    // Handle file upload for shop_photo
                    $filePath = null;
                    if ($request->hasFile('shop_photo')) {
                        $file = $request->file('shop_photo');
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        // Move the file to the public folder (within 'uploads/shops')
                        $file->move(public_path('uploads/shops'), $fileName);
                        
                        // Store only the relative path in the database
                        $filePath = 'uploads/shops/' . $fileName;
                    }


        // Create a new shop record in the database
        $shop = Shop::create([
            'shop_name' => $request->shop_name,
            'shop_description' => $request->shop_description,
            'shop_address' => $request->shop_address,
            'shop_phone' => $request->shop_phone,
            'shop_photo' => $filePath,  // Store the relative path
            'shop_email' => $request->shop_email,
            'user_id' => $user->id,  // Get the user ID from the authenticated user
            'is_approved' => true, // Set approval to false initially
        ]);

        // Return success response with the created shop data
        return response()->json([
            'success' => true,
            'message' => 'Shop registered successfully!',
            'data' => $shop,  // Optionally include the created shop data in the response
        ]);
     
    }
    public function shop($id){
        $shop = Shop::where('id', $id)->get();
         return response()->json(['product' => $shop]);     
    }
    public function shopdata($id)
    {
        // Fetch the shop by its ID
        $shop = Shop::where('id', $id)->first();
    
        // Check if the shop exists
        if (!$shop) {
            // If the shop doesn't exist, return a 404 error
            return response()->json(['error' => 'Shop not found'], 404);
        }
    
        // Return the shop data as a JSON response
        return response()->json(['shop' => $shop]);
    }
    public function shopRating(Request $request, $id)
    {
        // Check if shop_review is present in the request
        if (!$request->has('shop_review')) {
            return response()->json(['error' => 'shop_review is required'], 400);
        }
    
        // Fetch the shop by its ID
        $shop = Shop::find($id);
    
        // If the shop is not found, return a 404 error
        if (!$shop) {
            return response()->json(['error' => 'Shop not found'], 404);
        }
    
        // Get the new review from the request and convert it to a float
        $newReview = (float) $request->shop_review;
    
        // Add the new rating to the existing shop review
        $shop->shop_review = $shop->shop_review + $newReview;
    
        // Increment the number of reviews
        $shop->shop_review_no = $shop->shop_review_no + 1;
    
        // Save the updated shop information
        $shop->save();
    
        // Return the updated shop data as a JSON response
        return response()->json(['shop' => $shop]);
    }
    
}
