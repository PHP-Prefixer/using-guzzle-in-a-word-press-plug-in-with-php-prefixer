<?php /* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Promise\Tests;

use PPP\GuzzleHttp\Promise\TaskQueue;
use PHPUnit\Framework\TestCase;

class TaskQueueTest extends TestCase
{
    public function testKnowsIfEmpty()
    {
        $tq = new TaskQueue(false);
        $this->assertTrue($tq->isEmpty());
    }

    public function testKnowsIfFull()
    {
        $tq = new TaskQueue(false);
        $tq->add(function () {});
        $this->assertFalse($tq->isEmpty());
    }

    public function testExecutesTasksInOrder()
    {
        $tq = new TaskQueue(false);
        $called = [];
        $tq->add(function () use (&$called) { $called[] = 'a'; });
        $tq->add(function () use (&$called) { $called[] = 'b'; });
        $tq->add(function () use (&$called) { $called[] = 'c'; });
        $tq->run();
        $this->assertSame(['a', 'b', 'c'], $called);
    }
}
