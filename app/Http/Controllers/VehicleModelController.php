<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $vehicleModels = VehicleModel::all();
            return response()->json($vehicleModels);
        } catch (\Exception $e) {
            return response()->json(['error' => '无法获取车辆模型列表'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'brand_id' => 'required|exists:brands,id',
                // 其他字段的验证规则...
            ]);

            $vehicleModel = VehicleModel::create($validatedData);
            return response()->json($vehicleModel, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => '创建车辆模型时发生错误'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $vehicleModel = VehicleModel::findOrFail($id);
            return response()->json($vehicleModel);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到车辆模型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '获取车辆模型信息时发生错误'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $vehicleModel = VehicleModel::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'brand_id' => 'required|exists:brands,id',
                // 其他字段的验证规则...
            ]);

            $vehicleModel->update($validatedData);
            return response()->json($vehicleModel);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到车辆模型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '更新车辆模型时发生错误'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $vehicleModel = VehicleModel::findOrFail($id);
            $vehicleModel->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到车辆模型'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '删除车辆模型时发生错误'], 500);
        }
    }
}
