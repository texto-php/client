<?php

declare(strict_types=1);

namespace Texto\Client;

interface Message 
{
    public function getPhonenumber(): string;

    public function getMessage(): string;
}
