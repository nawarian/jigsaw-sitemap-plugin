<?php

namespace Nawarian\JigsawSitemapPlugin\Listener;

use TightenCo\Jigsaw\Jigsaw;

interface ListenerInterface
{
    public function handle(Jigsaw $app): void;
}
