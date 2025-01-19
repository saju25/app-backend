<?php
// controller file: app/Http/Controllers/Api/DmController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DmController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'dm_name' => 'required|string|max:255',
            'dm_address' => 'required|string|max:255',
            'dm_phone' => 'required|string|max:20',
            'dm_email' => 'required|email|unique:dm,dm_email',
            'face_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'id_card' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
            'pdf_contract' => 'required|mimes:pdf|max:20048',
            'is_approved' => 'nullable|boolean',  // Allow 'is_approved' to be optionally passed
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Prepare the data to be stored in the database
        $data = $request->only(['dm_name', 'dm_address', 'dm_phone', 'dm_email', 'is_approved']);
        $data['user_id'] = $user_id;  // Add the authenticated user's ID to the data

                    // Handle face photo upload
            if ($request->hasFile('face_photo')) {
                $file = $request->file('face_photo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Move the file to the public folder and store the relative path in the database
                $file->move(public_path('uploads/face_photos'), $fileName);
                $data['face_photo'] = 'uploads/face_photos/' . $fileName;
            }

            // Handle ID card upload
            if ($request->hasFile('id_card')) {
                $file = $request->file('id_card');
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Move the file to the public folder and store the relative path in the database
                $file->move(public_path('uploads/id_cards'), $fileName);
                $data['id_card'] = 'uploads/id_cards/' . $fileName;
            }

            // Handle contract PDF upload
            if ($request->hasFile('pdf_contract')) {
                $file = $request->file('pdf_contract');
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Move the file to the public folder and store the relative path in the database
                $file->move(public_path('uploads/pdf_contracts'), $fileName);
                $data['pdf_contract'] = 'uploads/pdf_contracts/' . $fileName;
            }


        // Create the DM (Delivery Man) record
        $dm = Dm::create($data);

        // Return the response
        return response()->json([
            'success' => true,
            'message' => 'Delivery Man registered successfully!',
            'dm' => $dm,
        ], 201);
    }


    public function getDm(){
        $user = Auth::user();
        $dm = Dm::where('user_id', $user->id)->first();
       return response()->json([
            'success'=>true,
            'dm' => $dm
        ]);
    }
}
