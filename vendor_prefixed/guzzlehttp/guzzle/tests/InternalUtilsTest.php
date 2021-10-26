<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Test;

use PPP\GuzzleHttp\Psr7;
use PPP\GuzzleHttp\Utils;
use PHPUnit\Framework\TestCase;

class InternalUtilsTest extends TestCase
{
    public function testCurrentTime()
    {
        self::assertGreaterThan(0, Utils::currentTime());
    }

    /**
     * @requires extension idn
     */
    public function testIdnConvert()
    {
        $uri = Psr7\Utils::uriFor('https://яндекс.рф/images');
        $uri = Utils::idnUriConvert($uri);
        self::assertSame('xn--d1acpjx3f.xn--p1ai', $uri->getHost());
    }
}
