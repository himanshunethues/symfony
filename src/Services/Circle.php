<?php

namespace App\Services;

class Circle  extends ShapeService implements ShapeType, ShapeAttributes
{

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
        return "circle";
    }

    public function getAttributes(): array
    {
        return [
            "radius" => (float)$this->a,
        ];
    }

    public function computeArea(): float
    {
        return number_format(pi() * ($this->a * $this->a), 2);
    }

    public function computeCircumference(): float
    {
        return number_format(2 * pi() * $this->a, 2);
    }
}