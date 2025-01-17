<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dm;
use App\Models\DriverLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
          
           'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        $user = Auth::user(); // Get the authenticated user
         if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
      
        $driver = Dm::where('user_id', $user->id)->first();

    
        $driverLocation = DriverLocation::create([
            'driver_id ' => 1,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_available' => false, // Set approval to false initially
        ]);

        // Return success response with the created shop data
        return response()->json([
            'success' => true,
            'message' => 'Driver Location registered successfully!',
            'data' =>    $driverLocation,  // Optionally include the created shop data in the response
        ]);
    }
    public function getDriverData($id)
    {
       
        $driver = Dm::where('id', $id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Driver data fetched successfully!',
            'data' => $driver,
        ]);
    }
}
