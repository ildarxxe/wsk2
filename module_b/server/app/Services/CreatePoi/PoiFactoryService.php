<?php
namespace App\Services\CreatePoi;
use App\Services\CreatePoi\PoiService;

class PoiFactoryService
{
    private $start;

    private $end;

    private $startPoint;

    private $width;

    private $height;

    public function __construct($start, $end, $width, $height)
    {
    $this->start = $start;
    $this->end = $end;
    $this->width = $width;
    $this->height = $height;
    $this->mapStartPoint();
    }

    private function calc($source, $target)
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

    private function mapStartPoint()
    {
    $calc = $this->calc($this->start, $this->end);

    $this->startPoint = [
    'x' => $calc['x'] / $this->width,
    'y' => $calc['y'] / $this->height
    ];
    }

    public function calculate($target)
    {
    $calc = $this->calc($this->start, $target);
    return [
    'x' => floor($calc['x'] / $this->startPoint['x']),
    'y' => floor($calc['y'] / $this->startPoint['y'])
    ];
    }
}
