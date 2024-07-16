<?php

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;

class ScreenshotController extends Controller
{
    public function index()
    {
        $screenshots = Screenshot::all(); 
        return view('screenshots.index', compact('screenshots'));
    }

    public function show($id)
    {
        $screenshot = Screenshot::findOrFail($id);
        return view('screenshot-view', compact('screenshot'));
    }

    public function store(Request $request)
    {
        $screenshotData = $request->getContent(); // Get the raw screenshot data
    
        // Validate the Base64 data
        if (!preg_match('/^data:image\/png;base64,/', $screenshotData)) {
            return response()->json(['error' => 'Invalid image data'], 400);
        }
    
        $filename = time().'.PNG'; // Generate a unique filename
       // Inside ScreenshotController@store method
        $path = public_path('images/screenshots/'.$filename);
        file_put_contents($path, base64_decode(str_replace('data:image/png;base64,', '', $screenshotData)));

        // Cache the path temporarily
        Cache::put('last_screenshot_path', $path, 60); // Expires in 60 minutes

        return response()->json(['success' => true]); // Return a success response
    }

}