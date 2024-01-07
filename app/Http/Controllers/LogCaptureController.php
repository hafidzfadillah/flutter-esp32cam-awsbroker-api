<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Models\LogCapture;
use Illuminate\Http\Request;

class LogCaptureController extends Controller
{
    protected $imageUploadService;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return LogCapture::all();
        try {
            $logs = LogCapture::all();

            return response()->json([
                'status' => 200,
                'data' => $logs,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error fetching log captures',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request
    , ImageUploadService $imageUploadService
    )
    {
        

        try {
            // Upload image to Google Cloud Storage and get the URL
            $imageUrl = $imageUploadService->upload($request->file('image'), 'log_captures'); // 'log_captures' is the folder name
            $request->validate([
                // 'image_url' => 'required|string', // Adjust the validation rule for image files
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rule for image files
                'capture_by' => 'required|string',
            ]);

            // Store data in the database
            $logCapture = LogCapture::create([
                // 'image_url' => $request->input('image_url'),
                'image_url' => $imageUrl,
                'capture_by' => $request->input('capture_by'),
            ]);

            return response()->json([
                'status' => 201,
                'message' => 'Log capture stored successfully',
                'image_url' => $logCapture->image_url,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error storing log capture',
            ], 500);
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image_url' => 'required|string',
    //         'capture_by' => 'required|string',
    //     ]);

    //     try {
    //         LogCapture::create($request->all());

    //         return response()->json([
    //             'status' => 201,
    //             'message' => 'Log capture stored successfully',
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 500,
    //             'message' => 'Error storing log capture',
    //         ], 500);
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return LogCapture::findOrFail($id);
        try {
            $log = LogCapture::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $log,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Log capture not found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $logCapture = LogCapture::findOrFail($id);
        $logCapture->delete();

        return response()->json(['status'=>201,'message' => 'Log capture deleted successfully']);
    
    }
}
