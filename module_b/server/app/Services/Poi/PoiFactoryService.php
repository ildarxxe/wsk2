<?php

namespace App\Services\Poi;
class PoiFactoryService
{
    private mixed $start;

    private mixed $end;

    private $startPoint;

    private int $width;

    private int $height;

    public function __construct($start = ['latitude' => 13.772478, 'longitude' => 100.482653], $end = ['latitude' => 13.736280, 'longitude' => 100.536051], $width = 1280, $height = 800)
    {
        $this->start = $start;
        $this->end = $end;
        $this->width = $width;
        $this->height = $height;
        $this->mapStartPoint();
    }

    private function calc($source, $target): array
    {
        $_a = new PoiService($source['latitude'], $target['longitude']);
        $a = new PoiService($target['latitude'], $target['longitude']);

        $y = $_a->distanceTo($a);

        $_b = new PoiService($source['latitude'], $source['longitude']);
        $b = new PoiService($source['latitude'], $target['longitude']);

        $x = $_b->distanceTo($b);

        return [
            'x' => $x,
            'y' => $y
        ];
    }

    private function mapStartPoint(): void
    {
        $calc = $this->calc($this->start, $this->end);

        $this->startPoint = [
            'x' => $calc['x'] / $this->width,
            'y' => $calc['y'] / $this->height
        ];
    }

    public function calculate($target): array
    {
        $calc = $this->calc($this->start, $target);

        return [
            'x' => floor($calc['x'] / $this->startPoint['x']),
            'y' => floor($calc['y'] / $this->startPoint['y'])
        ];
    }
}
