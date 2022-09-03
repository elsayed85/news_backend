<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteBaseController;
use Illuminate\Http\Request;

class NotificationController extends SiteBaseController
{
    public function listAll(Request $request)
    {
        $notifications = auth()->user()->notifications()->paginate(3);
        return view('notifications',[
            'notifications' => $notifications
        ]);
    }
}
