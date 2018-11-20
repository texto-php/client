<?php
declare(strict_types=1);

namespace Texto\Client\Tests\Model;

use PHPUnit\Framework\TestCase;
use Texto\Client\Model\Message;

class MessageTest extends TestCase
{
    /**
     * @var Message
     */
    private $message;

    protected function setup()
    {
        $this->message = new Message(['+01 1213123'], 'Foo', '+313123');
    }

    public function test_from()
    {
        $this->assertSame('+313123', $this->message->getFrom());
    }

    public function test_to()
    {
        $this->assertSame(['+01 1213123'], $this->message->getTo());
    }

    public function test_content()
    {
        $this->assertSame('Foo',$this->message->getContent());
    }
}
