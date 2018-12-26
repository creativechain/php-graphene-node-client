<?php

namespace GrapheneNodeClient\Tools\ChainOperations;

use GrapheneNodeClient\Commands\Single\BroadcastTransactionCommand;
use GrapheneNodeClient\Commands\Single\BroadcastTransactionSynchronousCommand;
use GrapheneNodeClient\Commands\CommandQueryData;
use GrapheneNodeClient\Connectors\ConnectorInterface;
use GrapheneNodeClient\Tools\Auth;
use GrapheneNodeClient\Tools\Transaction;

class OpAccountCreate
{
    /**
     * @param ConnectorInterface $connector
     * @param string $wif
     * @param $fee
     * @param string $creator
     * @param string $newAccountName
     * @param string $owner
     * @param string $active
     * @param string $posting
     * @param string $memo
     * @param string $jsonMetadata
     * @return mixed
     */
    public static function do(ConnectorInterface $connector, $wif, $fee, $creator, $newAccountName, $owner, $active, $posting, $memo, $jsonMetadata)
    {
        $chainName = $connector->getPlatform();
        /** @var CommandQueryData $tx */
        $tx = Transaction::init($connector);
        $tx->setParamByKey(
            '0:operations:0',
            [
                'account_create',
                [
                    'fee'    => $fee,
                    'creator' => $creator,
                    'new_account_name'   => $newAccountName,
                    'owner' => $owner,
                    'active'   => $active,
                    'posting'   => $posting,
                    'memo_key'   => $memo,
                    'json_metadata'   => $jsonMetadata,
                ]
            ]
        );

        $command = new BroadcastTransactionCommand($connector);////        echo '<pre>' . var_dump($commandQueryData->getParams(), $properties2) . '<pre>'; die; //FIXME delete it
        Transaction::sign($chainName, $tx, ['active' => $wif]);

        $answer = $command->execute(
            $tx
        );

        return $answer;
    }

    /**
     * @param ConnectorInterface $connector
     * @param string $wif
     * @param $fee
     * @param string $creator
     * @param string $newAccountName
     * @param array $owner
     * @param array $active
     * @param array $posting
     * @param string $memo
     * @param string $jsonMetadata
     *
     * @return array|object
     * @throws \Exception
     */
    public static function doSynchronous(ConnectorInterface $connector, $wif, $fee, $creator, $newAccountName, $owner, $active, $posting, $memo, $jsonMetadata)
    {
        $chainName = $connector->getPlatform();
        /** @var CommandQueryData $tx */
        $tx = Transaction::init($connector);
        $tx->setParamByKey(
            '0:operations:0',
            [
                'account_create',
                [
                    'fee'    => $fee,
                    'creator' => $creator,
                    'new_account_name'   => $newAccountName,
                    'owner' => $owner,
                    'active'   => $active,
                    'posting'   => $posting,
                    'memo_key'   => $memo,
                    'json_metadata'   => $jsonMetadata,
                ]
            ]
        );

        $command = new BroadcastTransactionSynchronousCommand($connector);////        echo '<pre>' . var_dump($commandQueryData->getParams(), $properties2) . '<pre>'; die; //FIXME delete it
        Transaction::sign($chainName, $tx, ['active' => $wif]);

        $answer = $command->execute(
            $tx
        );

        return $answer;
    }


}