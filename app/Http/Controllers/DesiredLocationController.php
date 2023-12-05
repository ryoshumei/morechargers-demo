<?php

namespace App\Http\Controllers;

use App\Models\DesiredLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            Log::error($e->getMessage());
            return response()->json(['error' => '无法获取期望位置列表'], 500);
        }
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
                'hope_radius' => 'required|integer',
                'has_ev_car' => 'required|boolean',
                'brand_id' => 'nullable|integer',
                'model_id' => 'nullable|integer',
                'charger_type_id' => 'nullable|integer',
                'provider_company_id' => 'nullable|integer',
                'user_id' => 'required|integer',
                'comment' => 'nullable|string',
                // 其他字段...
            ]);

            $desiredLocation = DesiredLocation::create($validatedData);
            return response()->json($desiredLocation, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
            Log::error($e->getMessage());
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '获取期望位置信息时发生错误'], 500);
        }
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
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
            Log::error($e->getMessage());
            return response()->json(['error' => '未找到期望位置'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '删除期望位置时发生错误'], 500);
        }
    }

    public function mapCoordinates(){
        try {
            $desiredLocations = DesiredLocation::all();
            $coordinates = [];
            foreach ($desiredLocations as $desiredLocation) {
                // add coordinates to array
                $coordinates[] = [
                    'latitude' => $desiredLocation->latitude,
                    'longitude' => $desiredLocation->longitude,
                ];
            }
            return response()->json($coordinates);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'could not get coordinates'], 500);
        }
    }
}
