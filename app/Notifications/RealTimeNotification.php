<?php

namespace App\Notifications;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class RealTimeNotification extends Notification implements ShouldBroadcast
{

    public string $message;
    public string $notification_type;

    public function __construct($notification_type , string $message)
    {
        $this->notification_type = $notification_type;
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => "$this->message (User $notifiable->id)",
            'notification_type' => $this->notification_type
        ]);
    }
}
