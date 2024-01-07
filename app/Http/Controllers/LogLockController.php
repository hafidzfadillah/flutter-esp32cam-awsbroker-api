<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogLock;
use Illuminate\Http\Request;

class LogLockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return LogLock::all();
        try {
            $locks = LogLock::all();

            return response()->json([
                'status' => 200,
                'data' => $locks,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error fetching log locks',
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
            'lock_status' => 'required|string',
            'rfid_number'=>'required|string',
            // 'timestamp' => 'required|date',
        ]);

        // return LogLock::create($request->all());
        try {
            LogLock::create($request->all());

            return response()->json([
                'status' => 201,
                'message' => 'Log lock stored successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error storing log lock',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return LogLock::findOrFail($id);
        try {
            $lock = LogLock::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $lock,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Log lock not found',
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
        $logLock = LogLock::findOrFail($id);
        $logLock->delete();

        return response()->json(['status'=>201,'message' => 'Log lock deleted successfully']);
    
    }
}
