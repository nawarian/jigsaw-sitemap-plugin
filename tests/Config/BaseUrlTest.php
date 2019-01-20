<?php

namespace Nawarian\Config;

use PHPUnit\Framework\TestCase;

class BaseUrlTest extends TestCase
{
    public function toStringProvider(): array
    {
        return [
            ['https://localhost:8080'],
            ['https://podentender.com'],
            ['https://www.podentender.com'],
        ];
    }

    /**
     * @param string $baseUrl
     * @dataProvider toStringProvider
     */
    public function testToStringReturnsBaseUrl(string $baseUrl): void
    {
        $baseUrlInstance = BaseUrl::createFromString($baseUrl);

        $this->assertSame($baseUrl, (string) $baseUrlInstance);
    }
}
