<?php

namespace Nawarian\JigsawSitemapPlugin\SitemapGenerator;

use Nawarian\JigsawSitemapPlugin\Config\BaseUrl;
use Nawarian\JigsawSitemapPlugin\SitemapGenerator\LastModified\LastModifiedStrategy;
use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;

class DefaultSitemapGenerator implements GeneratorInterface
{
    /**
     * @var BaseUrl
     */
    private $baseUrl;

    /**
     * @var LastModifiedStrategy
     */
    private $lastModifiedGenerator;

    /**
     * @var Sitemap
     */
    private $sitemap;

    public function __construct(BaseUrl $baseUrl, LastModifiedStrategy $lastModifiedGenerator, Sitemap $sitemap)
    {
        $this->baseUrl = $baseUrl;
        $this->lastModifiedGenerator = $lastModifiedGenerator;
        $this->sitemap = $sitemap;
    }

    public function generate(Jigsaw $app): void
    {
        collect($app->getOutputPaths())
            ->sortBy(function (string $path) {
                return $path;
            }, SORT_DESC, true)
            ->reject(function ($path) {
                // @todo add proper blacklist component
                return in_array($path, [
                    '/assets/*',
                    '*/favicon.ico',
                    '*/404',
                ]);
            })
            ->each(function ($path) {
                $url = rtrim((string) $this->baseUrl, '/') . $path;
                $lastModified = $this->lastModifiedGenerator->getLastModifiedTime($path);
                $this->sitemap->addItem($url, $lastModified, Sitemap::MONTHLY);
            });

        $this->sitemap->write();
    }
}
