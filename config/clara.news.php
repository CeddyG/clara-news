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
            'middleware' => ['web', 'access']
        ],
        'api' => [
            'prefix'    => 'admin',
            'middleware' => ['api', 'access']
        ]
    ],
    
];
