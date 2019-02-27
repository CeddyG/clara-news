<?php

/**
 * Default config values
 */
return [
    
    'route' => [
        'web' => [
            'middleware' => ['web']
        ],
        'web-admin' => [
            'prefix'    => 'admin',
            'middleware' => ['web', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class]
        ],
        'api' => [
            'prefix'    => 'admin',
            'middleware' => ['api', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class.':api']
        ]
    ],
    
];
