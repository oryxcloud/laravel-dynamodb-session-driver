<?php
return [

    /*
    |--------------------------------------------------------------------------
    | AWS Configuration details
    |--------------------------------------------------------------------------
    |
    */
    'region' => env('AWS_REGION', null),
    'key'    => env('AWS_ACCESS_KEY_ID', null),
    'secret' => env('AWS_SECRET_ACCESS_KEY', null),
    'endpoint' => env('DYNAMODB_HOST', null),

    /*
    |--------------------------------------------------------------------------
    | Hash key
    |--------------------------------------------------------------------------
    | Name of hash key in table. Default: "id".
    */
    'hash_key' => env('DYNAMODB_HASH_KEY', 'id'),
];
