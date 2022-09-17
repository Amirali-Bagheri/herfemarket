<?php

return [
    'name' => 'Admin',

    'routeName' => 'admin',//admin

    'middlewares' => [
        'web',
        'auth',
        'role:admin',
        // 'verifiedphone',
    ]
];
