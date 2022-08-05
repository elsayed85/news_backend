<?php

namespace App\Http\Controllers\Iot\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $device = Device::where('public_key', $request->public_key)->first();

        if (!$device || !Hash::check($request->private_key, $device->private_key)) {
            throw ValidationException::withMessages([
                'keys' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $device->createToken($device->name)->plainTextToken;

        return response()->json((["token" => $token, 'device_id' => $device->id]));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user("device")->tokens()->where('id', auth()->user("device")->currentAccessToken()->id)->delete();
        return response()->noContent();
    }
}
