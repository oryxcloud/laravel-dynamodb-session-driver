<?php
return [
    /*
    |--------------------------------------------------------------------------
    | AWS Configuration Details
    |--------------------------------------------------------------------------
    |
    */
    'region' => env('AWS_REGION', null),
    'key'    => env('AWS_ACCESS_KEY_ID', null),
    'secret' => env('AWS_SECRET_ACCESS_KEY', null),
    'endpoint' => env('DYNAMODB_HOST', null),

    /*
    |--------------------------------------------------------------------------
    | DynamoDB Session Configuration Details
    |--------------------------------------------------------------------------
    |
    */
    // Name of table to store the sessions. Default: config('session.table')
    'table_name' => env( 'DYNAMO_SESSIONS_TABLE', config('session.table') ),

    // Name of hash key in table. Default: "id"
    'hash_key' => env('DYNAMODB_HASH_KEY', 'id'),

    // Name of the data attribute in table. Default: "data"
    'data_attribute' => env('DYNAMODB_DATA_ATTRIBUTE', 'data'),

    // Name of the session life time attribute in table. Default: "expires"
    'session_lifetime_attribute' => env('DYNAMODB_SESSION_LIFETIME_ATTRIBUTE', 'expires')
];
