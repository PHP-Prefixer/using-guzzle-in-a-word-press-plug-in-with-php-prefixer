<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

declare(strict_types=1);

namespace PPP\GuzzleHttp\Tests\Psr7;

use PPP\GuzzleHttp\Psr7\BufferStream;
use PPP\GuzzleHttp\Psr7\DroppingStream;
use PHPUnit\Framework\TestCase;

class DroppingStreamTest extends TestCase
{
    public function testBeginsDroppingWhenSizeExceeded(): void
    {
        $stream = new BufferStream();
        $drop = new DroppingStream($stream, 5);
        self::assertSame(3, $drop->write('hel'));
        self::assertSame(2, $drop->write('lo'));
        self::assertSame(5, $drop->getSize());
        self::assertSame('hello', $drop->read(5));
        self::assertSame(0, $drop->getSize());
        $drop->write('12345678910');
        self::assertSame(5, $stream->getSize());
        self::assertSame(5, $drop->getSize());
        self::assertSame('12345', (string) $drop);
        self::assertSame(0, $drop->getSize());
        $drop->write('hello');
        self::assertSame(0, $drop->write('test'));
    }
}