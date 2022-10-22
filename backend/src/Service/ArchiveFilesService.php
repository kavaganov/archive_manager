<?php

namespace App\Service;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ArchiveFilesService
{
    const ARCHIVE_FILES_TASK_QUEUE = 'halk:archive_and_get_files';

    public function setArchiveFilesTask(array $packet): ?int
    {
        $connection = new AMQPStreamConnection(
            $_ENV['RABBITMQ_HOST'],
            $_ENV['RABBITMQ_PORT'],
            'guest',
            'guest',
        );

        $channel = $connection->channel();

        $channel->queue_declare(
            self::ARCHIVE_FILES_TASK_QUEUE,
            false,
            true,
            false,
            false
        );

        $id = rand(0, 10000000);
        $envelope = [
            'id' => $id,
            'data' => $packet
        ];
        $msg = new AMQPMessage(json_encode($envelope));
        try {
            $channel->basic_publish($msg, '', self::ARCHIVE_FILES_TASK_QUEUE);
        } catch (\Exception $exception) {
            return null;
        }

        $channel->close();
        $connection->close();

        return $id;
    }
}