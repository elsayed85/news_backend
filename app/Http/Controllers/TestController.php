<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    /**
     * Set user's active status
     *
     * @param Request $request
     * @return void
     */
    public function setActiveStatus(Request $request)
    {
        $update = (bool) $request['status']
            ? User::where('id', $request['user_id'])->update([
                'active_status' => 1,
                'last_seen_at' => now()
            ])
            : User::where('id', $request['user_id'])->update([
                'active_status' => 0,
                'last_seen_at' => now()
            ]);
        // send the response
        return Response::json([
            'status' => $update,
        ], 200);
    }
}
