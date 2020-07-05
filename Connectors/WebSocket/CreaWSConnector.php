<?php

namespace GrapheneNodeClient\Connectors\WebSocket;


class CreaWSConnector extends WSConnectorAbstract
{
    /**
     * @var string
     */
    protected $platform = self::PLATFORM_CREA;

    /**
     * wss or ws server
     *
     * if you set several nodes urls, if with first node will be trouble
     * it will connect after $maxNumberOfTriesToCallApi tries to next node
     *
     * @var string
     */
    protected static $nodeURL = [
        'https://nodes.creary.net',
    ];
}