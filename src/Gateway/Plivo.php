<?php
declare(strict_types=1);

namespace Texto\Client\Gateway;


use Plivo\Exceptions\PlivoRestException;
use Plivo\RestClient;
use Texto\Client\Exception\SentFailedException;
use Texto\Client\Gateway;
use Texto\Client\Message;

class Plivo implements Gateway
{
    private $client;

    public function __construct(RestClient $client)
    {
        $this->client = $client;
    }

    public function send(Message $message): void
    {
        try {
            $this->client->message->create(
                $message->getFrom(),
                $message->getTo(),
                $message->getContent()
            );
        } catch (PlivoRestException $e) {
            throw new SentFailedException('Could not send', null, $e);
        }
    }
}
