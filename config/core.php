<?php

return [
    'table_prefix' => 'svc',
    'auth' => [
        'user_model' => Systha\Core\Models\Admin::class,
        'jwt_secret' => env('ADMINPANEL_JWT_SECRET'),
        'jwt_ttl' => (int) env('ADMINPANEL_JWT_TTL', 120),
        'jwt_issuer' => env('ADMINPANEL_JWT_ISSUER', 'adminpanel'),
    ],
];
