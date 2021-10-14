<?php

declare(strict_types=1);

namespace App\Factory\Orders;

use App\Factory\Products\Cooking\Base\ProductToCookInterface;
use App\Factory\Products\Element;

final class SimpleOrder implements Order
{

    private array $products;

    /**
     * @param string $name
     */
    public function __construct(private string $name)
    {
        $this->products = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param ProductBuildInterface $builder
     */
    public function addProduct(ProductBuildInterface $builder)
    {
        $this->products[] = $builder->build();
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function printOrder()
    {
        echo $this->getName() . ":" . PHP_EOL;

        /** @var ProductToCookInterface $product */
        foreach ($this->products as $product) {

            if (!is_null($product)) {
                echo "- " . $product->getName() . ":" . PHP_EOL;

                /** @var Element $element */
                foreach($product->getElements() as $element) {
                    echo "- - " . $element->getName() . PHP_EOL;
                }
            }

        }
    }

}