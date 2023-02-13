<?php

namespace Packback\Lti1p3\DeepLinks;

class Icon
{
    private $url;
    private $width;
    private $height;

    public function __construct(string $url, int $width, int $height)
    {
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }

    public static function new(string $url, int $width, int $height): Icon
    {
        return new Icon($url, $width, $height);
    }

    public function setUrl(string $url): Icon
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setWidth(int $width): Icon
    {
        $this->width = $width;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setHeight(int $height): Icon
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
