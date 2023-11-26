<?php

namespace App\Http\Controllers;

use App\Models\DesiredLocation;
use Illuminate\Http\Request;

class DesiredLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $desiredLocations = DesiredLocation::all();
            return response()->json($desiredLocations);
        } catch (\Exception $e) {
            return response()->json(['error' => '无法获取期望位置列表'], 500);
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
        //
        try {
            $validatedData = $request->validate([
                // 添加验证规则
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                // 其他字段...
            ]);

            $desiredLocation = DesiredLocation::create($validatedData);
            return response()->json($desiredLocation, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => '创建期望位置时发生错误'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $desiredLocation = DesiredLocation::findOrFail($id);
            return response()->json($desiredLocation);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '获取期望位置信息时发生错误'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DesiredLocation $desiredLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $desiredLocation = DesiredLocation::findOrFail($id);

            $validatedData = $request->validate([
                // 添加验证规则
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                // 其他字段...
            ]);

            $desiredLocation->update($validatedData);
            return response()->json($desiredLocation);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '更新期望位置时发生错误'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $desiredLocation = DesiredLocation::findOrFail($id);
            $desiredLocation->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '删除期望位置时发生错误'], 500);
        }
    }
}
