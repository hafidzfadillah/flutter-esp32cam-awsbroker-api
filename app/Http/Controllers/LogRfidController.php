<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogRfid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LogRfidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $rfids = LogRfid::all();

            return response()->json([
                'status' => 200,
                'data' => $rfids,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error fetching log RFIDs',
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
    public function store(Request $request)
    {
        $request->validate([
            'rfid_number' => 
                'required|string',
        ]);

        // return LogRfid::create($request->all());
        try {
            LogRfid::create($request->all());

            return response()->json([
                'status' => 201,
                'message' => 'Log rfid stored successfully',
            ], 201);
        } catch (\Exception $e) {
            // Check if the exception is due to a duplicate entry
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            return response()->json([
                'status' => 422, // Unprocessable Entity
                'message' => 'Duplicate RFID entry',
            ], 422);
        }
        
            return response()->json([
                'status' => 500,
                'message' => 'Error storing log rfid',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return LogRfid::findOrFail($id);
        try {
            $rfid = LogRfid::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $rfid,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Log RFID not found',
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
        $logRfid = LogRfid::findOrFail($id);
        $logRfid->delete();

        return response()->json(['status'=>201,'message' => 'Log RFID deleted successfully']);
    
    }
}
