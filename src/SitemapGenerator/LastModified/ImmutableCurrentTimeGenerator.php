<?php

namespace Nawarian\SitemapGenerator\LastModified;

class ImmutableCurrentTimeGenerator implements LastModifiedStrategy
{
    private $time;

    public function getLastModifiedTime(string $path): int
    {
        if (null === $this->time) {
            $this->time = time();
        }

        return $this->time;
    }
}
