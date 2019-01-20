<?php

namespace Nawarian\JigsawSitemapPlugin\Listener;

use Nawarian\JigsawSitemapPlugin\SitemapGenerator\GeneratorInterface;
use TightenCo\Jigsaw\Jigsaw;

class SitemapListener implements ListenerInterface
{
    /**
     * @var GeneratorInterface
     */
    private $sitemapGenerator;

    public function __construct(GeneratorInterface $sitemapGenerator)
    {
        $this->sitemapGenerator = $sitemapGenerator;
    }

    public function handle(Jigsaw $app): void
    {
        $this->sitemapGenerator->generate($app);
    }
}
