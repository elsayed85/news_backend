<?php

use App\Filament\Resources\UserResource;

return [
    'resources'     => [
        'UserResource'       => UserResource::class,
        'RoleResource'       => \Phpsa\FilamentAuthentication\Resources\RoleResource::class,
        'PermissionResource' => \Phpsa\FilamentAuthentication\Resources\PermissionResource::class,
    ],
    'pages'         => [
        'Profile' => \Phpsa\FilamentAuthentication\Pages\Profile::class
    ],
    'Widgets'       => [
        'LatestUsers' => [
            'enabled' => true,
            'limit'   => 5,
            'sort'    => 0
        ],
    ],
    'preload_roles' => true,
    'impersonate'   => [
        'enabled'  => true,
        'guard'    => 'web',
        'redirect' => '/'
    ]
];
