<?php

namespace App\Factory\Products\Cooking;

use App\Factory\Products\Cooking\Base\ProductDecorator;
use App\Factory\Products\Element;
use App\Factory\Products\ProductInterface;

final class ProductWithElement implements ProductDecorator
{

    /**
     * @param ProductInterface $product
     * @param Element $newElement
     */
    public function __construct(protected ProductInterface $product, private Element $newElement)
    {

    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return array_merge($this->product->getElements(), [$this->newElement]);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->product->getName();
    }

}