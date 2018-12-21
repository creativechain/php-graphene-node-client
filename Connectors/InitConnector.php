<?php


namespace GrapheneNodeClient\Connectors;


use GrapheneNodeClient\Connectors\Http\CreaHttpJsonRpcConnector;
use GrapheneNodeClient\Connectors\Http\VizHttpJsonRpcConnector;
use GrapheneNodeClient\Connectors\WebSocket\CreaWSConnector;

class InitConnector
{
    /**
     * @var ConnectorInterface
     */
    protected static $connectors = [];
    protected static $platforms = [
        ConnectorInterface::PLATFORM_GOLOS,
        ConnectorInterface::PLATFORM_CREA
    ];

    public static function getConnector($platform)
    {
        if (!in_array($platform, self::$platforms)) {
            throw new \Exception('Wrong platform');
        }
        if (!isset(self::$connectors[$platform])) {
            if ($platform === ConnectorInterface::PLATFORM_VIZ) {
                self::$connectors[$platform] = new VizHttpJsonRpcConnector();
            } elseif ($platform === ConnectorInterface::PLATFORM_GOLOS) {
                self::$connectors[$platform] = new CreaWSConnector();
            } elseif ($platform === ConnectorInterface::PLATFORM_CREA) {
                self::$connectors[$platform] = new CreaHttpJsonRpcConnector();
            }
        }

        return self::$connectors[$platform];
    }
}