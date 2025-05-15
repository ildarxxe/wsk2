<?php
namespace App\Services\CreateTarget;

class CreateTargetService {
    private $min;
    private $max;

    public function __construct($min, $max) {
        $this->min = $min;
        $this->max = $max;
        $this->randomFloat($this->min, $this->max);
    }

    public static function randomFloat($min, $max): float|int
    {
        return $min + ($max - $min) * (rand() / getrandmax());
    }
}
