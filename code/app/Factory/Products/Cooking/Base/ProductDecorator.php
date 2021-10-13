<?php

declare(strict_types=1);

namespace App\Factory\Products\Cooking\Base;

use App\Factory\Products\Element;
use App\Factory\Products\ProductInterface;

interface ProductDecorator extends ProductInterface
{

    public function __construct(ProductInterface $product, Element $newElement);

}
