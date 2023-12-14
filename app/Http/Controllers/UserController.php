<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        print "hello from index";
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to get users list'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $requestData  = $request->all();
            $requestData['ip_address'] = $request->ip();
            $requestData['account_type'] = 'signed_up';
            Log::info('Request data with IP:', $requestData);
            $requestData['user_role'] = $request['userRole'];
            $validatedData = Validator::make($requestData, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'user_role' => 'required|in:user,provider',
                'ip_address' => 'required|ip',
                'account_type' => 'required|in:anonymous,signed_up,google',
            ])->validated();

            $validatedData['password'] = Hash::make($validatedData['password']);
            Log::info('validatedData:', $validatedData);
            $user = User::create($validatedData);
            // log $user
            Log::info('Created user:', $user->toArray());
            return response()->json($user, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            Log::error('Validation error: ' . $e->getMessage());
            Log::error('Validation errors: ', $e->errors());
            Log::error('All Request Data: ', $validatedData);
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '创建用户时发生错误'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '未找到用户'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '获取用户信息时发生错误'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // get user id from request
            $id = $request->user()->id;
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
            // todo password change

//              'password' => 'sometimes|required',
            ]);
            // todo password change
//            if (!empty($validatedData['password'])) {
//                $validatedData['password'] = Hash::make($validatedData['password']);
//            }
            // if name is changed, update it
            if($user->name !== $validatedData['name']){
                $user->name = $validatedData['name'];
            }
            $user->save();
            return response()->json($user);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'not found user'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'error when updating'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // get user id from request
            $id = $request->user()->id;
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '未找到用户'], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => '删除用户时发生错误'], 500);
        }
    }
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        return $request->user();
    }

    // count users
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        try {
            $count = User::count();
            return response()->json($count);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'unable to get users count'], 500);
        }
    }
}
