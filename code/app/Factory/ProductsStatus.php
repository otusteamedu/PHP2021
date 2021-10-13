<?php

declare(strict_types=1);

namespace App\Factory;

use App\Factory\Products\ProductInterface;
use SplSubject;
use SplObserver;

final class ProductsStatus implements SplObserver
{

    /**
     * @param ProductInterface $subject
     */
    public function update(SplSubject $subject): void
    {
        /** @var ProductInterface $subject*/
        echo $subject->getName() . " - " . $subject->getStatus() . PHP_EOL;
    }

}