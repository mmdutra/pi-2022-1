<?php

$databaseUrl = parse_url(env('CLEARDB_DATABASE_URL', ''));

return [
    'default' => env('DB_CONNECTION', 'local'),
    'connections' => [
        'local' => [
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'homestead'),
            'username' => env('DB_USERNAME', 'homestead'),
            'password' => env('DB_PASSWORD', 'secret'),
        ],
        'clear_db' => [
            'driver' => 'mysql',
            'host' => $databaseUrl['host'],
            'port' => 3306,
            'database' => substr($databaseUrl['path'], 1),
            'username' => $databaseUrl['user'],
            'password' => $databaseUrl['pass'],
        ]
    ]
];
