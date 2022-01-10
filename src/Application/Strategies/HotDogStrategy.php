<?php


namespace App\Application\Strategies;



use App\Application\Visitors\Visitor;
use App\Domain\Models\BaseProduct;
use App\Infrastructure\Iterators\RecieptIterator;

class HotDogStrategy extends AbstractStrategy
{
    public function make(array $fillings = null): BaseProduct
    {
        $hotDog = $this->factory->createHotDog();
        $hotDog->setReceiptFilling($fillings);
        $fillings = new RecieptIterator($hotDog, $this->visitor);
        foreach ($fillings as $filling) {
            $hotDog->fillings[] = $filling;
        }
        return $hotDog;
    }
}