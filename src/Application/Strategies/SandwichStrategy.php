<?php


namespace App\Application\Strategies;

use App\Domain\Models\BaseProduct;
use App\Infrastructure\Iterators\RecieptIterator;

class SandwichStrategy extends AbstractStrategy
{

    public function make(array $fillings = null) :BaseProduct
    {
        $sandwich = $this->factory->createSandwich();
        $sandwich->setReceiptFilling($fillings);
        $fillings = new RecieptIterator($sandwich, $this->visitor);
        foreach ($fillings as $filling) {
            $sandwich->fillings[] = $filling;
        }
        return $sandwich;
    }
}