<?php
namespace Td141\DynamoDbSessionDriver\Extensions;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\SessionHandler;
use SessionHandlerInterface;

class DynamoHandler implements SessionHandlerInterface
{
     /** @var DynamoDbClient Client for DynamoDb */
    protected $client;

     /** @var SessionHandler DynamoDb Session Handler */
    protected $handler;

    /**
     * @param DynamoDbClient $connection
     * @param array $config
     */
    public function __construct(DynamoDbClient $client, array $config)
    {
        $this->client              = $client;
        $config['dynamodb_client'] = $client;
        $this->handler             = \Aws\DynamoDb\SessionHandler::fromClient($client, $config);
    }

    /**
     * Open a session for writing.
     *
     * @param string $savePath    Session save path.
     * @param string $sessionName Session name.
     *
     * @return bool Whether or not the operation succeeded.
     */
    public function open($save_path, $session_id)
    {
        return $this->handler->open($save_path, $session_id);
    }

    /**
     * Satisfies the session handler interface, but does nothing.
     * There's no need to close the session from writing
     * @return bool Success
     */
    public function close()
    {
        return true;
    }

    /**
     * Delete a session stored in DynamoDB.
     *
     * @param string $id Session ID.
     *
     * @return bool Whether or not the operation succeeded.
     */
    public function destroy($session_id)
    {
        return $this->handler->destroy($session_id);
    }

    /**
     * Satisfies the session handler interface, but does nothing. To do garbage
     * collection, you must run the command...
     *
     * @param int $maxLifetime Ignored.
     *
     * @return bool Whether or not the operation succeeded.
     */
    public function gc($max_lifetime)
    {
        return $this->handler->gc($max_lifetime);
    }

    /**
     * Triggers garbage collection on expired sessions.
     */
    public function garbageCollect()
    {
        return $this->handler->garbageCollect();
    }

    /**
     * Read a session stored in DynamoDB.
     *
     * @param string $id Session ID.
     *
     * @return string Session data.
     */
    public function read($session_id)
    {
        return $this->handler->read($session_id);
    }

    /**
     * Write a session to DynamoDB.
     *
     * @param string $id   Session ID.
     * @param string $data Serialized session data to write.
     *
     * @return bool Whether or not the operation succeeded.
     */
    public function write($session_id, $session_data)
    {
        return $this->handler->write($session_id, $session_data);
    }
}
