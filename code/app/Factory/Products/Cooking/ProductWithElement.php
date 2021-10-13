<?php

namespace App\Factory\Products\Cooking;

use App\Factory\Products\Cooking\Base\ProductDecorator;
use App\Factory\Products\Element;
use App\Factory\Products\ProductInterface;

final class ProductWithElement implements ProductDecorator
{

    public function __construct(protected ProductInterface $product, private Element $newElement)
    {

    }

    public function getElements(): array
    {
        return array_merge($this->product->getElements(), [$this->newElement]);
    }

    public function getName(): string
    {
        return $this->product->getName();
    }

}