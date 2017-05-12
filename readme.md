# DynamoDB Session Driver for Laravel 5

This package is a Laravel Session Driver for [DynamoDB](https://aws.amazon.com/dynamodb)

## Installation
This package can be installed through Composer.

```
composer require oryxcloud/laravel-dynamodb-session-driver
```

After updating composer, add the service provider to the `providers` array in `config/app.php`

```
'providers' => [
    ...
    OryxCloud\DynamoDbSessionDriver\SessionServiceProvider::class,
    ...
];
```

You can publish the config file of this package with this command:

```
php artisan vendor:publish --provider="OryxCloud\DynamoDbSessionDriver\SessionServiceProvider"
```

The following config file will be published in `config/dynamodb-session.php`

```
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

    /*
    |--------------------------------------------------------------------------
    | Hash key
    |--------------------------------------------------------------------------
    | Name of hash key in table. Default: "id".
    */
    'hash_key' => env('DYNAMODB_HASH_KEY', 'id'),
];

```

You should also add the specified keys in your `.env` file.

## Usage

After going through all the installation steps, the `dynamodb` Session driver will now be available to be used. So you can just change the following line in your `.env` file.

```
SESSION_DRIVER=dynamodb
```

## Contributors
- [Mozammil Khodabacchas](https://github.com/mozammil)
- [Jomit Jose](https://github.com/jomoos)

## Credits
[DynamoDb Session Handler for Symfony 2](https://github.com/gwkunze/dynamo-session-bundle)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.

