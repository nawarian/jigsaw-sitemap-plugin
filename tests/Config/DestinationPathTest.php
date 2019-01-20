<?php

namespace Nawarian\Config;

use PHPUnit\Framework\TestCase;

class DestinationPathTest extends TestCase
{
    public function testToStringReturnsJoinedPaths(): void
    {
        $path = DestinationPath::createFromString('part1', 'part2');
        $this->assertSame('part1/part2', (string) $path);

        $path = DestinationPath::createFromString('part1/part2', 'part3');
        $this->assertSame('part1/part2/part3', (string) $path);
    }
}
