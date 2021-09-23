<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

declare(strict_types=1);

namespace PPP\GuzzleHttp\Tests\Psr7;

class HasToString
{
    public function __toString(): string
    {
        return 'foo';
    }
}
