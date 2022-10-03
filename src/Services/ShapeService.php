<?php

namespace App\Services;

use Exception;

abstract class ShapeService implements Shape
{

    /**
     * @throws Exception
     */
    public static function getInstance(string $shape): object
    {
        switch ($shape) {
            case 'triangle':
                $result = new Triangle();
                break;
            case 'circle':
                $result = new Circle();
                break;
            default:
                throw new Exception("Invalid Shape");
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function circumference(): float
    {
        return $this->computeCircumference();
    }

    /**
     * @throws Exception
     */
    public function surface(): float
    {
        return $this->computeArea();
    }

    abstract public function computeArea(): float;

    abstract public function setAttributes($a, $b, $c);

    abstract public function computeCircumference(): float;
}