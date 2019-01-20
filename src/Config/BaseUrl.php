<?php

namespace Nawarian\Config;

class BaseUrl
{
    private $url;

    private function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function createFromString(string $url): self
    {
        return new self($url);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }
}
