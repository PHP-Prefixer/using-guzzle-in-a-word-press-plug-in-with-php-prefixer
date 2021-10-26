<?php /* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Promise\Tests;

use PPP\GuzzleHttp\Promise\AggregateException;
use PHPUnit\Framework\TestCase;

class AggregateExceptionTest extends TestCase
{
    public function testHasReason()
    {
        $e = new AggregateException('foo', ['baz', 'bar']);
        $this->assertStringContainsString('foo', $e->getMessage());
        $this->assertSame(['baz', 'bar'], $e->getReason());
    }
}
