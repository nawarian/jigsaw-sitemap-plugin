<?php

namespace Nawarian\SitemapGenerator\LastModified;

interface LastModifiedStrategy
{
    public function getLastModifiedTime(string $path): int;
}
