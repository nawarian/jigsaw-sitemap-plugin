<?php

namespace Nawarian\Listener;

use Nawarian\SitemapGenerator\DefaultSitemapGenerator;
use Nawarian\SitemapGenerator\GeneratorInterface;
use Nawarian\SitemapGenerator\LastModified\ImmutableCurrentTimeGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;

class SitemapListenerTest extends TestCase
{
    public function testHandle(): void
    {
        $baseUrl = 'https://localhost:8080/';
        $lastModifiedDateGenerator = new ImmutableCurrentTimeGenerator();

        /** @var Jigsaw|MockObject $app */
        $app = $this->createMockWithDisabledConstructor(
            Jigsaw::class,
            'getConfig',
            'getOutputPaths'
        );
        $app->expects($this->once())
            ->method('getConfig')
            ->with(GeneratorInterface::BASE_URL_KEY)
            ->willReturn($baseUrl);

        $app->expects($this->once())
            ->method('getOutputPaths')
            ->willReturn(['/path1', '/path2']);

        /** @var Sitemap|MockObject $sitemap */
        $sitemap = $this->createMockWithDisabledConstructor(Sitemap::class, 'write', 'addItem');

        $sitemap->expects($this->once())
            ->method('write')
            ->willReturn(null);

        $sitemap->expects($this->exactly(2))
            ->method('addItem')
            ->withConsecutive(
                [$baseUrl.'path2', $lastModifiedDateGenerator->getLastModifiedTime(''), Sitemap::MONTHLY],
                [$baseUrl.'path1', $lastModifiedDateGenerator->getLastModifiedTime(''), Sitemap::MONTHLY]
            )
            ->willReturn(null);

        $generator = new DefaultSitemapGenerator($app, $lastModifiedDateGenerator, $sitemap);
        $listener = new SitemapListener($generator);
        $listener->handle($app);
    }

    private function createMockWithDisabledConstructor(string $class, string ...$methods)
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }
}
