<?php

namespace App\Factory\Products;

final class EmptyProduct implements ProductInterface
{

    /**
     * @param Product $product
     */
    public function __construct(private Product $product)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->product->getName();
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return [];
    }
}