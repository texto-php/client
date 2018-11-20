<?php
declare(strict_types=1);

namespace Texto\Client\Tests\Gateway;

use MessageBird\Client;
use MessageBird\Resources\Messages;
use Prophecy\Argument;
use Texto\Client\Gateway\MessageBird;
use PHPUnit\Framework\TestCase;
use Texto\Client\Model\Message;

class MessageBirdTest extends TestCase
{
    private $client;

    private $gateway;

    protected function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->gateway = new MessageBird($this->client->reveal());
    }

    public function testSend()
    {
        $resource = $this->prophesize(Messages::class);
        $resource->create(Argument::that(function($obj) {
            if ('321' !== $obj->originator) {
               return false;
            }

            if (['123'] !== $obj->recipients) {
                return false;
            }

            if ('Foo' !== $obj->body) {
                return false;
            }

            return true;
        }))->shouldBeCalled();

        $this->client->messages = $resource;

        $msg = new Message(['123'], 'Foo', '321');

        $this->gateway->send($msg);
    }
}
