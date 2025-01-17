<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:6048',
        ]);

        // Check if the file is present in the request
        if ($request->file()) {
            // Generate a unique name for the image
            $fileName = time() . '_' . $request->file->getClientOriginalName();

            // Define the path where the image will be stored in the public folder
            $filePath = public_path('uploads/' . $fileName);

            // Move the file to the public/uploads directory
            $request->file('file')->move(public_path('uploads'), $fileName);

            // Return the success response with the file URL
            return response()->json([
                'success' => true,
                'filePath' => '/uploads/' . $fileName // URL to access the file directly
            ], 200);
        }

        // If no file is uploaded, return failure response
        return response()->json([
            'success' => false,
            'message' => 'File upload failed.'
        ], 400);
    }
}
