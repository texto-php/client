<?php
declare(strict_types=1);

namespace Texto\Client\Tests\Gateway;

use PHPUnit\Framework\TestCase;
use Texto\Client\Gateway\Twilio;
use Texto\Client\Model\Message;
use Twilio\Rest\Api\V2010\Account\MessageList;
use Twilio\Rest\Client;

class TwilioTest extends TestCase
{
    private $client;

    private $gateway;

    protected function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->gateway = new Twilio($this->client->reveal());
    }

    public function testSend()
    {
        $list = $this->prophesize(MessageList::class);
        $list->create('+1234', [
            'from' =>  'Foo',
            'body' => 'Foo'
        ])->shouldBeCalled();

        $this->client->messages = $list->reveal();

        $msg = new Message('+1234', 'Foo', 'Foo');
        $this->gateway->send($msg);
    }
}
