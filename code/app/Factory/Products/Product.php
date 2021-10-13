<?php

declare(strict_types=1);

namespace App\Factory\Products;

abstract class Product implements ProductInterface
{

    private array $elements = [];

    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->doBaseRecipe();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    protected abstract function doBaseRecipe();

}