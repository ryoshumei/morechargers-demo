<?php

namespace App\Http\Controllers;

use App\Models\ProviderCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to list provider companies'], 500);
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
                // 其他字段的验证规则...
            ]);

            $providerCompany = ProviderCompany::create($validatedData);
            return response()->json($providerCompany, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to create provider company'], 500);
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
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find provider'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to get provider company'], 500);
        }
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
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find provider'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to update provider'], 500);
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
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to find provider'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to delete'], 500);
        }
    }

    // count provider companies
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        try {
            $count = ProviderCompany::count();
            return response()->json($count);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to get providers count'], 500);
        }
    }
}
