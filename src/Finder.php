<?php

declare(strict_types=1);

namespace Greendrake\LSLR;

class Finder
{

    private $x;
    private $y;

    public function __construct()
    {
        $this->clear();
    }

    public function clear()
    {
        $this->x = [];
        $this->y = [];
    }

    public function add(float $x, float $y)
    {
        $this->x[] = $x;
        $this->y[] = $y;
    }

    // Finds "a" and "b" in "y = a*x + b" that best fits the data
    public function __invoke() :array
    {
        if (($n = count($this->x)) < 2) {
            throw new \RuntimeException('At least two points required');
        }
        $sumX = array_sum($this->x);
        $sumY = array_sum($this->y);
        $sumX2 = array_reduce($this->x, function($sum, $x) {
            return $sum + $x**2;
        }, 0);
        $i = 0;
        $sumXY = array_reduce($this->x, function($sum, $x) use(&$i) {
            return $sum + $x * $this->y[$i++];
        }, 0);
        $a = ($n*$sumXY - $sumX*$sumY) / ($n*$sumX2 - $sumX**2);
        return [$a, ($sumY - $a*$sumX) / $n];
    }

}