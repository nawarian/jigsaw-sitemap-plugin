<?php

namespace Nawarian\JigsawSitemapPlugin\SitemapGenerator\LastModified;

interface LastModifiedStrategy
{
    public function getLastModifiedTime(string $path): int;
}
