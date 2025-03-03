<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Events\MessageSent; // Import the event
use App\Models\Dm;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUserData()
    {
        $user = Auth::user();
        return response()->json([
                    'user' => $user,
                ]);
    }


    public function getUserOrder($id)
    {
        $user = Auth::user();
    
        $uniqueId = Str::uuid();
    
        $order = Order::find($id);
    
       if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $order->paymentid = $uniqueId;
    
        $order->save();
    
        return response()->json([
            'user' => $user,
            'unique_id' => $uniqueId,
             'order' => $order,
        ]);
    }


    public function shopUser($id)
    {
        // Fetch the shop by its ID
        $shop = Shop::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $shop->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }
    public function driverUser($id)
    {
        // Fetch the shop by its ID
        $dm = Dm::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $dm->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }
    public function orderUser($id)
    {
        // Fetch the shop by its ID
        $order = Order::where('id', $id)->first();
    
        // Fetch the user associated with the shop
        $user = User::where('id', $order->user_id)->first();
    
        // Return both the shop and user details in the response
        return response()->json([
             'user' => $user,  // Add the user details
        ]);
    }


    public function store(Request $request)
    {
        // Validate the incoming device_id
        $request->validate([
            'device_id' => 'required|string|unique:devices,device_id', // Ensures the device_id is unique
        ]);
    
        // Store or update the device in the database
        Device::updateOrCreate(
            ['device_id' => $request->device_id], // The unique condition
            ['device_id' => $request->device_id] // Data to insert or update
        );
    
        return response()->json(['message' => 'Device token stored successfully.']);
    }
    
  
    public function getMessage()
    {
        return view('admin.message');
    }


    public function sendNotification(Request $request)
    {
        $client = new Client();
    
         $title = $request->input('title');
        $body = $request->input('body');
    
        $push = Device::pluck('device_id')->toArray();
        $pushT = array_filter($push); 
    
        foreach ($pushT as $token) {
            $pushToken = $token;
    
            $message = [
                'to' => $pushToken,
                'sound' => 'default',
                'title' => $title,
                'body' => $body,
                'data' => ['extraData' => 'some extra data'], 
            ];
    
            try {
                $response = $client->post('https://exp.host/--/api/v2/push/send', [
                    'json' => $message,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ]
                ]);
    
                $result = json_decode($response->getBody()->getContents(), true);
    
               if (isset($result['data']) && isset($result['data']['status']) && $result['data']['status'] === 'ok') {
                    return response()->json(['message' => 'Notification sent successfully!', 'status' => 'success']);
                } else {
                   \Log::error("Error from Expo API: " . json_encode($result));
                    return response()->json(['message' => 'Failed to send notification', 'status' => 'error', 'error_details' => $result]);
                }
            } catch (\Exception $e) {
                \Log::error("Error sending notification: " . $e->getMessage());
                return response()->json(['message' => 'Error sending notification: ' . $e->getMessage(), 'status' => 'error']);
            }
        }
    }
      
}
