<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

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
            return response()->json(['error' => '无法获取反馈列表'], 500);
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
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => '创建反馈时发生错误'], 500);
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
            return response()->json(['error' => '未找到反馈'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '获取反馈信息时发生错误'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
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
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到反馈'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '更新反馈时发生错误'], 500);
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
            return response()->json(['error' => '未找到反馈'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '删除反馈时发生错误'], 500);
        }
    }
}
