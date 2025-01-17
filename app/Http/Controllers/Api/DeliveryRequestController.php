<?php
namespace App\Http\Controllers\Api;

use App\Events\DeliveryRequestList;
use App\Events\DeliveryRequestUpdated;
use App\Http\Controllers\Controller;
use App\Models\DeliveryRequest;
use App\Models\Dm;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryRequestController extends Controller
{
    /**
     * Store a new delivery request
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'driver_id' => 'required|max:255',
            'order_id' => 'required|max:255',
        ]);

        $user = Auth::user();
        $shop = Shop::where('user_id', $user->id)->first();
        
        // Create the delivery request
        $deliveryRequest = DeliveryRequest::create([
            'driver_id' => $validated['driver_id'],
            'order_id' => $validated['order_id'],
            'shop_id' => $shop->id,
        ]);
        
         // Broadcast the event to notify the driver in real-time
    broadcast(new DeliveryRequestUpdated($deliveryRequest, $validated['driver_id']));
    
        return response()->json([
            'message' => 'Delivery request created successfully',
            'data' => $deliveryRequest
        ], 201);
    }

    /**
     * Get a specific delivery request
     */
    public function getDeliveryRequest($driver_id, $order_id)
    {
        $deliveryRequest = DeliveryRequest::where('driver_id', $driver_id)
                                          ->where('order_id', $order_id)
                                          ->first();

        if (!$deliveryRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'No delivery request found for this driver.',
                'data' => null
            ], 404); // Return 404 if not found
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Delivery request fetched successfully',
            'data' => $deliveryRequest
        ], 200); // Return 200 OK if found
    }

    /**
     * Delete a specific delivery request
     */
    public function destroy($driver_id, $order_id)
    {
       $deliveryRequest = DeliveryRequest::where('driver_id', $driver_id)
                                          ->where('order_id', $order_id)
                                          ->first();

        if ($deliveryRequest) {
         $deliveryRequest->delete();
    
      return response()->json([
                'message' => 'Delivery request deleted successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Delivery request not found',
        ], 404);
    }

    /**
     * Get all delivery requests for a specific driver
     */
    public function getList($driver_id)
    {
        $deliveryRequests = DeliveryRequest::where('driver_id', $driver_id)->get();

        return response()->json([
            'message' => 'Delivery requests fetched successfully',
            'data' => $deliveryRequests
        ], 200);
    }

    /**
     * Accept a delivery request for a specific order
     */
    public function acceptRequest($id)
    {
        $user = Auth::user();
        $driver_id = Dm::Where('user_id', $user->id)->first();
        $order = Order::find($id);

        $order->driver_id = $driver_id->id;
        $order->status = 'accepted';
        $order->save();

        // Delete the previous delivery requests for this order
        $deletedCount = DeliveryRequest::where('order_id', $id)->delete();

        if ($deletedCount > 0) {
            return response()->json(['message' => "$deletedCount delivery request(s) deleted successfully."], 200);
        }

        return response()->json(['message' => 'No delivery requests found with the provided order_id.'], 404);
    }
}
