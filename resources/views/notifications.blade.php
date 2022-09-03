@extends('layouts.app')
@section('main_content')
    <div class="container">
        <h3>
            الاشعارات
        </h3>

        <div class="notification-ui_dd-content">
            @foreach ($notifications as $notification)
                <div class="notification-list notification-list--unread">
                    <div class="notification-list_feature-img">
                        <i class="notify-icon icon-notification"></i>
                    </div>
                    <div class="notification-list_content">
                        <div class="notification-list_detail">
                            <p>
                                {{ $notification->title ?? "" }}
                            </p>
                            <p class="text-muted">
                                {{ $notification->message ?? "" }}
                            </p>
                            <p class="text-muted"><small>{{ $notification->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {{ $notifications->render() }}
        </div>

    </div>
@endsection
