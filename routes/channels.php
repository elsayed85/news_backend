<?php

use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return ((int) $user->id === (int) $id) && get_class($user) == User::class;
});

Broadcast::channel('App.Device.{device_id}', function ($device , $device_id) {
    return get_class($device) == Device::class && $device->id == $device_id;
});
