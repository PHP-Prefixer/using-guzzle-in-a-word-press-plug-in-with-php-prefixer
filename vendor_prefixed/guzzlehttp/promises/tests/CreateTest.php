<?php /* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Promise\Tests;

use PPP\GuzzleHttp\Promise as P;
use PPP\GuzzleHttp\Promise\FulfilledPromise;
use PPP\GuzzleHttp\Promise\Promise;
use PPP\GuzzleHttp\Promise\PromiseInterface;
use PPP\GuzzleHttp\Promise\RejectedPromise;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testCreatesPromiseForValue()
    {
        $p = P\Create::promiseFor('foo');
        $this->assertInstanceOf(FulfilledPromise::class, $p);
    }

    public function testReturnsPromiseForPromise()
    {
        $p = new Promise();
        $this->assertSame($p, P\Create::promiseFor($p));
    }

    public function testReturnsPromiseForThennable()
    {
        $p = new Thennable();
        $wrapped = P\Create::promiseFor($p);
        $this->assertNotSame($p, $wrapped);
        $this->assertInstanceOf(PromiseInterface::class, $wrapped);
        $p->resolve('foo');
        P\Utils::queue()->run();
        $this->assertSame('foo', $wrapped->wait());
    }

    public function testReturnsRejection()
    {
        $p = P\Create::rejectionFor('fail');
        $this->assertInstanceOf(RejectedPromise::class, $p);
        $this->assertSame('fail', PropertyHelper::get($p, 'reason'));
    }

    public function testReturnsPromisesAsIsInRejectionFor()
    {
        $a = new Promise();
        $b = P\Create::rejectionFor($a);
        $this->assertSame($a, $b);
    }

    public function testIterForReturnsIterator()
    {
        $iter = new \ArrayIterator();
        $this->assertSame($iter, P\Create::iterFor($iter));
    }
}
