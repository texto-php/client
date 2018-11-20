<?php

declare(strict_types=1);

namespace Texto\Client;

interface Gateway
{
    public function send(Message $message): void;
}
