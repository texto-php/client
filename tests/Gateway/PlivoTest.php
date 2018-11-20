<?php
declare(strict_types=1);

namespace Texto\Client\Tests\Gateway;

use PHPUnit\Framework\TestCase;
use Plivo\Resources\Message\Message;
use Plivo\Resources\Message\MessageInterface;
use Plivo\RestClient;
use Texto\Client\Gateway\Plivo;

class PlivoTest extends TestCase
{
    /**
     * @var RestClient
     */
    private $client;

    /**
     * @var Plivo
     */
    private $gateway;

    protected function setUp()
    {
        $this->client = $this->prophesize(RestClient::class);
        $this->gateway = new Plivo($this->client->reveal());
    }

    public function testSend()
    {
        $resource = $this->prophesize(MessageInterface::class);
        $resource->create('321', ['123'], 'Foo')->shouldBeCalled();

        $this->client->message = $resource->reveal();

        $msg = new \Texto\Client\Model\Message(['123'], 'Foo', '321');

        $this->gateway->send($msg);
    }
}
