<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
       return view('admin.bannerlist', ['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banneradd');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // You can set the max size here
        ]);

        $filePath = null;
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Move the file to the public folder (within 'uploads/shops')
            $file->move(public_path('uploads/banner'), $fileName);
            
            // Store only the relative path in the database
            $filePath = 'uploads/banner/' . $fileName;
        }
        Banner::create([
            'banner' => $filePath, // Store the file path
        ]);
       return redirect()->route('banner_index')->with('success', 'Banner uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        // Find the banner by ID
        $banner = Banner::find($id);
    
        // Check if the banner exists
        if ($banner) {
            // Get the file path from the database
            $filePath = public_path($banner->banner);
    
            // Check if the file exists and delete it
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
    
            // Delete the banner record from the database
            $banner->delete();
    
            // Redirect back with success message
            return redirect()->route('banner_index')->with('success', 'Banner deleted successfully.');
        } else {
            // If the banner does not exist, show an error
            return redirect()->route('banner_index')->with('error', 'Banner not found.');
        }
    }
}
