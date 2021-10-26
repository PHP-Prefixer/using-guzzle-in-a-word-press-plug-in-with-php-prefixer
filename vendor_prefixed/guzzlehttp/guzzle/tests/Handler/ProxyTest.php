<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Test\Handler;

use PPP\GuzzleHttp\Handler\MockHandler;
use PPP\GuzzleHttp\Handler\Proxy;
use PPP\GuzzleHttp\Psr7\Request;
use PPP\GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;

/**
 * @covers \GuzzleHttp\Handler\Proxy
 */
class ProxyTest extends TestCase
{
    public function testSendsToNonSync()
    {
        $a = $b = null;
        $m1 = new MockHandler([static function ($v) use (&$a) {
            $a = $v;
        }]);
        $m2 = new MockHandler([static function ($v) use (&$b) {
            $b = $v;
        }]);
        $h = Proxy::wrapSync($m1, $m2);
        $h(new Request('GET', 'http://foo.com'), []);
        self::assertNotNull($a);
        self::assertNull($b);
    }

    public function testSendsToSync()
    {
        $a = $b = null;
        $m1 = new MockHandler([static function ($v) use (&$a) {
            $a = $v;
        }]);
        $m2 = new MockHandler([static function ($v) use (&$b) {
            $b = $v;
        }]);
        $h = Proxy::wrapSync($m1, $m2);
        $h(new Request('GET', 'http://foo.com'), [RequestOptions::SYNCHRONOUS => true]);
        self::assertNull($a);
        self::assertNotNull($b);
    }

    public function testSendsToStreaming()
    {
        $a = $b = null;
        $m1 = new MockHandler([static function ($v) use (&$a) {
            $a = $v;
        }]);
        $m2 = new MockHandler([static function ($v) use (&$b) {
            $b = $v;
        }]);
        $h = Proxy::wrapStreaming($m1, $m2);
        $h(new Request('GET', 'http://foo.com'), []);
        self::assertNotNull($a);
        self::assertNull($b);
    }

    public function testSendsToNonStreaming()
    {
        $a = $b = null;
        $m1 = new MockHandler([static function ($v) use (&$a) {
            $a = $v;
        }]);
        $m2 = new MockHandler([static function ($v) use (&$b) {
            $b = $v;
        }]);
        $h = Proxy::wrapStreaming($m1, $m2);
        $h(new Request('GET', 'http://foo.com'), ['stream' => true]);
        self::assertNull($a);
        self::assertNotNull($b);
    }
}
