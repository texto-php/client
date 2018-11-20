<?php
declare(strict_types=1);

namespace Texto\Client\Gateway;

use MessageBird\Client;
use MessageBird\Exceptions\MessageBirdException;
use Texto\Client\Exception\SentFailedException;
use Texto\Client\Gateway;
use Texto\Client\Message;

class MessageBird implements Gateway
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(Message $message): void
    {
        $object = new \MessageBird\Objects\Message();
        $object->originator = $message->getFrom();
        $object->recipients = $message->getTo();
        $object->body = $message->getContent();

        try {
            $this->client->messages->create($object);
        } catch (MessageBirdException $e) {
            throw new SentFailedException('Could not sent message', 0, $e);
        }
    }
}
