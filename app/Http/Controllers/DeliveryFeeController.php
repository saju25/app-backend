<?php

namespace App\Http\Controllers;

use App\Models\DeliveryFee;
use Illuminate\Http\Request;

class DeliveryFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryFees = DeliveryFee::first();

        // Return success response with the delivery fees data
        return response()->json([
            'success' => true,
            'message' => 'Delivery Fees retrieved successfully.',
            'fee' => $deliveryFees,  // Optionally include the delivery fees data in the response
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fee' => 'required',
        ]);
      
      $deliveryFree = DeliveryFee::create([
            'fee' => $request->fee,
        ]);

        // Return success response with the created shop data
        return response()->json([
            'success' => true,
            'message' => 'Delivery Free registered successfully!',
            'data' =>    $deliveryFree,  // Optionally include the created shop data in the response
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryFee $deliveryFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryFee $deliveryFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryFee $deliveryFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryFee $deliveryFee)
    {
        //
    }
}
