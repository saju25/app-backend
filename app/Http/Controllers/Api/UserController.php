<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Events\MessageSent; // Import the event
use App\Models\Dm;
use App\Models\Notification;
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
        
        // Save notification once before sending
        // Notification::create([
        //     'title' => $title,
        //     'body' => $body,
        // ]);
      
        
        // Get device tokens and filter out any empty ones
        $pushTokens = array_filter(Device::pluck('device_id')->toArray());
        
        // Prepare the notification payload
        $notificationData = [
            'sound' => 'default',
            'title' => $title,
            'body' => substr($body, 0, 50),  // Trim body to 50 characters
            'data' => ['extraData' => 'some extra data'],
        ];
    
        // Track success and failure of notifications
        $successCount = 0;
        $failureCount = 0;
        $errorDetails = [];
    
        // Send notifications to all devices
        foreach ($pushTokens as $pushToken) {
            try {
                $notificationData['to'] = $pushToken;
        
                // Send notification via Expo API
                $response = $client->post('https://exp.host/--/api/v2/push/send', [
                    'json' => $notificationData,
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ]
                ]);
        
                // Decode the response
                $result = json_decode($response->getBody()->getContents(), true);
        
                // Check if the notification was sent successfully
                if (isset($result['data']['status']) && $result['data']['status'] === 'ok') {
                    $successCount++;
                } else {
                    $failureCount++;
                    $errorDetails[] = "Error sending to token $pushToken: " . json_encode($result);
                }
            } catch (\Exception $e) {
                $failureCount++;
                $errorDetails[] = "Error sending to token $pushToken: " . $e->getMessage();
            }
        }
    
    Notification::create([
            'title' => $title,
            'message' => $body,
        ]);
        if ($successCount > 0) {
            return response()->json([
                'message' => 'Notifications sent successfully!',
                'status' => 'success',
                'success_count' => $successCount,
                'failure_count' => $failureCount,
                'error_details' => $errorDetails
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to send any notifications',
                'status' => 'error',
                'failure_count' => $failureCount,
                'error_details' => $errorDetails
            ]);
        }
    }
    public function message()
    {
        $message = Notification::all();
        return response()->json([
            'message' => $message,
        ]);
    }
    public function s_message($id)
    {
        $message = Notification::where('id', $id)->first();
        return response()->json([
            'message' => $message,
        ]);
    }
      
}
