<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Tests\Exception;

use PPP\GuzzleHttp\Exception\BadResponseException;
use PPP\GuzzleHttp\Psr7\Request;
use PPP\GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class BadResponseExceptionTest extends TestCase
{
    public function testHasNoResponse()
    {
        $req = new Request('GET', '/');
        $prev = new \Exception();
        $response = new Response();
        $e = new BadResponseException('foo', $req, $response, $prev);
        self::assertSame($req, $e->getRequest());
        self::assertSame($response, $e->getResponse());
        self::assertTrue($e->hasResponse());
        self::assertSame('foo', $e->getMessage());
        self::assertSame($prev, $e->getPrevious());
    }
}
