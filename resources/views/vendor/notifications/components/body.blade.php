<div
    @class([
        'filament-notifications-body mt-1 text-sm text-gray-500',
        'dark:text-gray-400' => config('notifications.dark_mode'),
    ])
>
    {{ $slot }}
</div>
