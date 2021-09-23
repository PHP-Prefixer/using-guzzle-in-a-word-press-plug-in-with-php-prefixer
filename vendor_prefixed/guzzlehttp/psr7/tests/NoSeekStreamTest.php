<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

declare(strict_types=1);

namespace PPP\GuzzleHttp\Tests\Psr7;

use PPP\GuzzleHttp\Psr7\NoSeekStream;
use PHPUnit\Framework\TestCase;
use PPP\Psr\Http\Message\StreamInterface;

/**
 * @covers GuzzleHttp\Psr7\NoSeekStream
 * @covers GuzzleHttp\Psr7\StreamDecoratorTrait
 */
class NoSeekStreamTest extends TestCase
{
    public function testCannotSeek(): void
    {
        $s = $this->createMock(StreamInterface::class);
        $s->expects(self::never())->method('seek');
        $s->expects(self::never())->method('isSeekable');
        $wrapped = new NoSeekStream($s);
        self::assertFalse($wrapped->isSeekable());
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Cannot seek a NoSeekStream');
        $wrapped->seek(2);
    }

    public function testToStringDoesNotSeek(): void
    {
        $s = \PPP\GuzzleHttp\Psr7\Utils::streamFor('foo');
        $s->seek(1);
        $wrapped = new NoSeekStream($s);
        self::assertSame('oo', (string) $wrapped);

        $wrapped->close();
    }
}
