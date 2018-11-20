<?php
declare(strict_types=1);

namespace Texto\Client\Model;

use Texto\Client\Message as MessageInterface;

class Message implements MessageInterface
{
    /**
     * @var array
     */
    private $to;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $content;

    /**
     * Message constructor.
     *
     * @param string $to
     * @param string $content
     * @param string|null $from
     */
    public function __construct(array $to, string $content, string $from = null)
    {
        $this->to = $to;
        $this->from = $from;
        $this->content = $content;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function addTo(string $number): void
    {
        $this->to[] = $number;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
