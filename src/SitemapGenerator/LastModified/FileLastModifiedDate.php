<?php

namespace Nawarian\JigsawSitemapPlugin\SitemapGenerator\LastModified;

class FileLastModifiedDate implements LastModifiedStrategy
{
    public function getLastModifiedTime(string $path): int
    {
        return filemtime($path);
    }
}
