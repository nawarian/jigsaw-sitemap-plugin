<?php

namespace Nawarian\SitemapGenerator;

use TightenCo\Jigsaw\Jigsaw;

interface GeneratorInterface
{
    const BASE_URL_KEY = 'baseUrl';

    public function generate(Jigsaw $app): void;
}
