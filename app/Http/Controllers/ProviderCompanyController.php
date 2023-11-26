<?php

namespace App\Http\Controllers;

use App\Models\ProviderCompany;
use Illuminate\Http\Request;

class ProviderCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $providerCompanies = ProviderCompany::all();
            return response()->json($providerCompanies);
        } catch (\Exception $e) {
            return response()->json(['error' => '无法获取供应商公司列表'], 500);
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
                'name' => 'required|max:255',
                // 其他字段的验证规则...
            ]);

            $providerCompany = ProviderCompany::create($validatedData);
            return response()->json($providerCompany, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => '创建供应商公司时发生错误'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $providerCompany = ProviderCompany::findOrFail($id);
            return response()->json($providerCompany);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到供应商公司'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '获取供应商公司信息时发生错误'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProviderCompany $providerCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $providerCompany = ProviderCompany::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                // 其他字段的验证规则...
            ]);

            $providerCompany->update($validatedData);
            return response()->json($providerCompany);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到供应商公司'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '更新供应商公司时发生错误'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $providerCompany = ProviderCompany::findOrFail($id);
            $providerCompany->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => '未找到供应商公司'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => '删除供应商公司时发生错误'], 500);
        }
    }
}
