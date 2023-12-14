<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $feedbacks = Feedback::all();
            return response()->json($feedbacks);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to list feedbacks'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'text' => 'required|string',
                'img_url' => 'nullable|url',
                'user_id' => 'nullable|exists:users,id', // 确保 user_id 存在于 users 表中
                // 其他字段的验证规则...
            ]);

            $feedback = Feedback::create($validatedData);
            return response()->json($feedback, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to create feedback'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            return response()->json($feedback);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find feedback'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when getting feedback'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $feedback = Feedback::findOrFail($id);

            $validatedData = $request->validate([
                'text' => 'required|string',
                'img_url' => 'nullable|url',
                'user_id' => 'nullable|exists:users,id',
                // 其他字段的验证规则...
            ]);

            $feedback->update($validatedData);
            return response()->json($feedback);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find feedback'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when finding feedback'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find feedback'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when deleting feedback'], 500);
        }
    }
}
