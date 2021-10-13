<?php

declare(strict_types=1);

namespace App\Factory\Combos;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;

final class SimpleOrder implements Order
{

    private array $products;

    public function __construct(private string $name)
    {
        $this->products = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addProduct(ProductBuildInterface $builder)
    {
        $this->products[] = $builder->build();
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function printOrder()
    {
        echo $this->getName() . ":" . PHP_EOL;

        /** @var ProductToCookInterface $product */
        foreach ($this->products as $product) {
            echo $product->getName() . PHP_EOL;
        }
    }

}