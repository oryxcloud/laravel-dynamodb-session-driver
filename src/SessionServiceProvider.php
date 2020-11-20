<?php
namespace OryxCloud\DynamoDbSessionDriver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Aws\DynamoDb\DynamoDbClient;
use OryxCloud\DynamoDbSessionDriver\Extensions\DynamoHandler;

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

            $config = [
                'region'  => config('dynamodb-session.region'),
                'version' => 'latest',
                'endpoint' => config('dynamodb-session.endpoint'),
            ];

            if (config('dynamodb-session.key') !== null && config('dynamodb-session.secret') !== null){
                $config['credentials'] = [ 
                    'key'    => config('dynamodb-session.key'),
                    'secret' => config('dynamodb-session.secret'),
                ];

            }
            $client = new DynamoDbClient($config);

            $config = [
                'table_name'       => config('dynamodb-session.table_name'),
                'hash_key'         => config('dynamodb-session.hash_key'),
                'data_attribute'         => config('dynamodb-session.data_attribute'),
                'session_lifetime' => 60 * config('session.lifetime'),
                'session_lifetime_attribute' => config('dynamodb-session.session_lifetime_attribute')
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
