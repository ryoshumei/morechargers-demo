<?php

namespace App\Http\Controllers;

use App\Models\ChargerType;
use Illuminate\Http\Request;

class ChargerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $chargerTypes = ChargerType::all();
            return response()->json($chargerTypes);
        } catch (\Exception $e) {
            return response()->json(['error' => '无法获取充电器类型列表'], 500);
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
                'name' => 'required|max:255',
                // 其他字段的验证规则...
            ]);

            $chargerType = ChargerType::create($validatedData);
            return response()->json($chargerType, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => '创建充电器类型时发生错误'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $chargerType = ChargerType::findOrFail($id);
            return response()->json($chargerType);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到充电器类型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '获取充电器类型信息时发生错误'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChargerType $chargerType)
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
            $chargerType = ChargerType::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                // 其他字段的验证规则...
            ]);

            $chargerType->update($validatedData);
            return response()->json($chargerType);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到充电器类型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '更新充电器类型时发生错误'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $chargerType = ChargerType::findOrFail($id);
            $chargerType->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到充电器类型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '删除充电器类型时发生错误'], 500);
        }
    }
}
