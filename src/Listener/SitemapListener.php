<?php

namespace Nawarian\JigsawSitemapPlugin\Listener;

use Nawarian\JigsawSitemapPlugin\SitemapGenerator\DefaultSitemapGenerator;
use Nawarian\JigsawSitemapPlugin\SitemapGenerator\GeneratorInterface;
use TightenCo\Jigsaw\Jigsaw;

class SitemapListener implements ListenerInterface
{
    const DEFAULT_SITEMAP_STRATEGY = DefaultSitemapGenerator::class;

    public function handle(Jigsaw $app): void
    {
        $generatorClassName = $app->getConfig('sitemap.strategy') ?? self::DEFAULT_SITEMAP_STRATEGY;
        if (!class_exists($generatorClassName)) {
            $generatorClassName = self::DEFAULT_SITEMAP_STRATEGY;
        }

        /** @var GeneratorInterface $generatorStrategy */
        $generatorStrategy = new $generatorClassName();
        $generatorStrategy->generate($app);
    }
}
