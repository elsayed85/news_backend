<?php

namespace App\Http\Controllers\Iot\V1;

use App\Events\Device\SendPayloadEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SendPayloadRequest;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * @param SendPayloadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(SendPayloadRequest $request)
    {
        $device = $request->user();
        $payload = json_decode($request->payload);
        if (!$payload) {
            $payload = [
                'bpm_value' => rand(10, 90),
                'temperature_value' => rand(-20, 25),
                'light_is_on' => collect([true, false])->random()
            ];
        }
        event((new SendPayloadEvent($device->id, $payload)));
        return response()->json([
            'device' => $device->id,
            'success' => true,
            'payload' => $payload
        ]);
    }
}
