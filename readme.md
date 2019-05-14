# DynamoDB Session Driver for Laravel 5

This package is a Laravel Session Driver for [DynamoDB](https://aws.amazon.com/dynamodb)

## Installation
This package can be installed through Composer.

```shell
$ composer require oryxcloud/laravel-dynamodb-session-driver
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```php
'providers' => [
    ...
    OryxCloud\DynamoDbSessionDriver\SessionServiceProvider::class,
    ...
];
```

You can publish the config file of this package with this command:

```shell
$ php artisan vendor:publish --provider="OryxCloud\DynamoDbSessionDriver\SessionServiceProvider"
```

The following config file will be published in `config/dynamodb-session.php`

```php
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

```

You should also add the specified keys in your `.env` file.

## Usage

After going through all the installation steps, the `dynamodb` Session driver will now be available to be used. So you can just change the following line in your `.env` file.

```shell
SESSION_DRIVER=dynamodb
```

## Contributors
- [Mozammil Khodabacchas](https://github.com/mozammil)
- [Jomit Jose](https://github.com/jomoos)
- [Alessio Nobile](https://github.com/alessionobile)

## Credits
[DynamoDb Session Handler for Symfony 2](https://github.com/gwkunze/dynamo-session-bundle)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.
