<?php

declare(strict_types=1);

namespace App\Factory\Products;

final class Element
{

    private string $name;

    private float $weight;

    /**
     * @param string $name
     * @param float $weight
     */
    public function __construct(string $name, float $weight = 1)
    {
        $this->name = $name;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

}