<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopLocation;
use Illuminate\Http\Request;

class ShopLocationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $location = ShopLocation::create($validated);
        return response()->json($location, 201);
    }
    public function getLocation()
    {
        $shopLocation = ShopLocation::all(); // Add the missing semicolon here
        return response()->json(['shopLocation' => $shopLocation]); 
    }
    public function getLocationmap()
    {
        $shops = Shop::with('location')->get(); // Fetch all shops with their related locations
        return response()->json($shops); // Return the data as JSON
    }

    public function updates(Request $request, $id)
    {
       
         $shopLocation = ShopLocation::where('shop_id', $id)->first();
    
        if (!$shopLocation) {
            return response()->json(['message' => 'Cart item not found or unauthorized'], 404);
        }
    
        $updateData = [];
       
        if ($request->has('shop_id')) {
            $updateData['shop_id'] = $request->input('shop_id');
        }
        if ($request->has('latitude')) {
            $updateData['latitude'] = $request->input('latitude');
        }
        if ($request->has('longitude')) {
            $updateData['longitude'] = $request->input('longitude');
        }
      
    
        // If there is data to update, proceed with the update
        if (!empty($updateData)) {
            $shopLocation->update($updateData);
        }
    
        return response()->json([
            'message' => 'Cart item updated successfully',
            'data' => $shopLocation,
        ], 200);
    }

}
