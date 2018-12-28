<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedMethods' => ['*'],
    'allowedHeaders' => ['Access-Control-Allow-Origin', 'Content-Type', 'X-Requested-With', 'Authorization', ''],

];
