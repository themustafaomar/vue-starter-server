<?php

return [
    'super-admin' => [
        'roles' => '*',
        'permissions' => '*',
        'users' => '*',
        'settings' => '*'
    ],
    'admin' => [
        'roles' => [
            'view' => true,
            'create' => false,
            'update' => false,
            'delete' => false
        ],
        'permissions' => [
            'view' => true,
            'create' => false,
            'update' => false,
            'delete' => false
        ],
        'users' => [
            'view' => true,
            'create' => true,
            'update' => true,
            'delete' => false
        ],
        'settings' => [
            'view' => true,
            'create' => true,
            'update' => true,
            'delete' => false
        ],
    ],
    'moderator' => [
        'settings' => [
            'view' => true,
            'create' => false,
            'update' => false,
            'delete' => false
        ],
    ],
    'regular' => [
        // ..
    ]
    // Add feature roles here..
];
