<?php

namespace App\Http\Controllers;

use App\Http\Resources\DesiredLocationResource;
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
        Log::info('DesiredLocationController - Index method reached');
        try {
            $locations = DesiredLocation::with(['brand', 'vehicleModel', 'user', 'chargerType', 'providerCompany'])->get();
            return DesiredLocationResource::collection($locations);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'could not get desiredLocations'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // validate the request data
            $validatedData = $request->validate([
                'radius' => 'required|numeric',
                'hasEv' => 'required|boolean',
                'evBrandId' => 'nullable|integer',
                'evModel' => 'nullable|integer',
                'providerCompany' => 'required|integer',
                'chargerType' => 'required|integer',
                'comment' => 'nullable|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);
            // create the model data
            $modelData = [
                'hope_radius' => $validatedData['radius'],
                'has_ev_car' => $validatedData['hasEv'],
                'brand_id' => $validatedData['evBrandId'],
                'model_id' => $validatedData['evModel'],
                'charger_type_id' => $validatedData['chargerType'],
                'provider_company_id' => $validatedData['providerCompany'],
                'latitude' => $validatedData['latitude'],
                'longitude' => $validatedData['longitude'],
            ];
            // if the user is authenticated, add user_id
            if (auth()->check()) {
                $modelData['user_id'] = auth()->id();
            }

            // if the comment is not empty, add comment
            if (!empty($validatedData['comment'])) {
                $modelData['comment'] = $validatedData['comment'];
            }
            $desiredLocation = DesiredLocation::create($modelData);
            return response()->json($desiredLocation, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when creating'], 500);
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
            return response()->json(['error' => 'unable to find location'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when finding location'], 500);
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
            return response()->json(['error' => 'unable to find location'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when updating location'], 500);
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
            return response()->json(['error' => 'unable to find location'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when deleting location'], 500);
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

    // count desired locations
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        try {
            $count = DesiredLocation::count();
            return response()->json($count);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to get desired locations count'], 500);
        }
    }
}
