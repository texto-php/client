<?php

declare(strict_types=1);

namespace Texto\Client;

interface Message 
{
    public function getFrom(): string;

    public function getTo(): string;

    public function getContent(): string;
}
