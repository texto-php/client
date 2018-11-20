<?php
declare(strict_types=1);

namespace Texto\Client\Gateway;

use Texto\Client\Exception\SentFailedException;
use Texto\Client\Gateway;
use Texto\Client\Message;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio implements Gateway
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(Message $message): void
    {
        try {
            $this->client->messages->create($message->getTo(), [
                'from' => $message->getFrom(),
                'body' => $message->getContent()
            ]);
        } catch (TwilioException $e) {
            throw new SentFailedException('Could not send message.', null, $e);
        }
    }
}
