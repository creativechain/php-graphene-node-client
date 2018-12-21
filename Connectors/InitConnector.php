<?php


namespace GrapheneNodeClient\Connectors;


use GrapheneNodeClient\Connectors\Http\CreaHttpJsonRpcConnector;

class InitConnector
{
    /**
     * @var ConnectorInterface
     */
    protected static $connectors = [];
    protected static $platforms = [
        ConnectorInterface::PLATFORM_CREA
    ];

    public static function getConnector($platform)
    {
        if (!in_array($platform, self::$platforms)) {
            throw new \Exception('Wrong platform');
        }
        if (!isset(self::$connectors[$platform])) {
            if ($platform === ConnectorInterface::PLATFORM_CREA) {
                self::$connectors[$platform] = new CreaHttpJsonRpcConnector();
            }
        }

        return self::$connectors[$platform];
    }
}