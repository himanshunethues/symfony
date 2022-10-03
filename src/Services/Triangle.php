<?php

namespace App\Services;

class Triangle extends ShapeService implements ShapeType, ShapeAttributes
{
    public $a;
    public $b;
    public $c;

    public function __construct()
    {
    }

    public function setAttributes($a, $b, $c){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getType(): string
    {
        return "triangle";
    }

    public function getAttributes(): array
    {
        return [
            "a" => (float)$this->a,
            "b" => (float)$this->b,
            "c" => (float)$this->c,
        ];
    }

    public function computeArea(): float
    {
        return ($this->a + $this->b + $this->c)/2;
    }

    public function computeCircumference(): float
    {
        return $this->a + $this->b + $this->c;
    }
}