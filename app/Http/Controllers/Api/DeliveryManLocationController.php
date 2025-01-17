<?php

namespace App\Http\Controllers\Api;

use App\Events\DriverLocation;
use App\Http\Controllers\Controller;
use App\Models\DeliveryManLocation;
use App\Models\Dm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\DriverLocationUpdated;
class DeliveryManLocationController extends Controller
{
  
     public function getLocation()
     {
         // Get the authenticated user
         $user = Auth::user();
         
         // Get the delivery man record based on the user
         $dmid = Dm::where('user_id', $user->id)->first();
     
         // Retrieve the latest location of the delivery man
         $location = DeliveryManLocation::where('delivery_man_id', $dmid->id)->first();
         
         if (!$location) {
             return response()->json([
                 'success' => false,
                 'message' => 'No location data found for the delivery man.',
             ], 404);  // Explicit 404 with a detailed message
         }
     
         return response()->json([
             'success' => true,
             'data' => $location,
         ], 200);
     }
     public function deliverynamLocationGet()
     {
          $deliveryMan = Dm::with('locations')->get();
          return response()->json($deliveryMan);
      }
       


     public function store(Request $request)
     {
         // Validate the request
         $validator = Validator::make($request->all(), [
             'latitude' => 'required|numeric',
             'longitude' => 'required|numeric',
         ]);
     
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors(),
             ], 422);
         }
     
         $user = Auth::user();
         $dmid = Dm::where('user_id', $user->id)->first();
     
         // Create a new location record
         $location = DeliveryManLocation::create([
             'delivery_man_id' => $dmid->id,
             'latitude' => $request->input('latitude'),
             'longitude' => $request->input('longitude'),
             'is_avialable' => true,
         ]);
     
         // Fire the event
         broadcast(new DriverLocationUpdated($location));  // Broadcast the location update event
     
         return response()->json([
             'success' => true,
             'message' => 'Location saved successfully.',
             'data' => $location,
         ], 201);
     }
     
     public function update(Request $request)
     {
         // Validate the request
         $validator = Validator::make($request->all(), [
             'latitude' => 'required|numeric',
             'longitude' => 'required|numeric',
         ]);
     
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors(),
             ], 422);
         }
     
         $user = Auth::user();
         $dmid = Dm::where('user_id', $user->id)->first();
     
         if (!$dmid) {
             return response()->json([
                 'success' => false,
                 'message' => 'Delivery man not found.',
             ], 404);
         }
     
         // Find the existing location record
         $location = DeliveryManLocation::where('delivery_man_id', $dmid->id)->first();
     
         if (!$location) {
             return response()->json([
                 'success' => false,
                 'message' => 'Location record not found.',
             ], 404);
         }
     
         // Update the location data
         $location->update([
             'latitude' => $request->input('latitude'),
             'longitude' => $request->input('longitude'),
             'is_avialable' => true,
         ]);
     
         // Fire the event
         broadcast(new DriverLocationUpdated($location));  // Broadcast the updated location
     
         return response()->json([
             'success' => true,
             'message' => 'Location updated successfully.',
             'data' => $location,
         ], 200);
     }
     
     
}
