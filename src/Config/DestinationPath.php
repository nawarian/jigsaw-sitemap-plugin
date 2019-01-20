<?php

namespace Nawarian\JigsawSitemapPlugin\Config;

class DestinationPath
{
    private $path;

    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public static function createFromString(string ...$paths): self
    {
        return new self(implode(DIRECTORY_SEPARATOR, $paths));
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function __toString(): string
    {
        return $this->getPath();
    }
}
