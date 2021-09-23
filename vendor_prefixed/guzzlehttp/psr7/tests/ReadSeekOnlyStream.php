<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */
declare(strict_types=1);

namespace PPP\GuzzleHttp\Tests\Psr7;

use PPP\GuzzleHttp\Psr7\Stream;
use PPP\GuzzleHttp\Psr7\Utils;

final class ReadSeekOnlyStream extends Stream
{
    public function __construct()
    {
        parent::__construct(Utils::tryFopen('php://memory', 'wb'));
    }

    public function isSeekable(): bool
    {
        return true;
    }

    public function isReadable(): bool
    {
        return false;
    }
}
