<?php
namespace OryxCloud\DynamoDbSessionHandler;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Aws\DynamoDb\DynamoDbClient;
use OryxCloud\DynamoDbSessionHandler\Extensions\DynamoHandler;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dynamodb-session.php' => config_path('dynamodb-session.php'),
        ]);

        Session::extend('dynamodb', function($app)
        {
            $client = new DynamoDbClient([
                'region'  => config('dynamodb-session.region'),
                'version' => 'latest',
                'credentials' => [
                    'key'    => config('dynamodb-session.key'),
                    'secret' => config('dynamodb-session.secret'),
                ],
            ]);

            $config = [
                'table_name'       => config('session.table'),
                'hash_key'         => config('dynamodb-session.hash_key'),
                'session_lifetime' => 60 * config('session.lifetime')
            ];

            return new DynamoHandler($client, $config);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/dynamodb-session.php', 'dynamodb-session'
        );
    }
}
