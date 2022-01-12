<?php


namespace App\Application\Strategies;


use App\Application\Visitors\Visitor;
use App\Domain\Models\BaseProduct;
use App\Domain\VisitorInterface;
use App\Infrastructure\Iterators\RecieptIterator;

class BurgerStrategy extends AbstractStrategy
{
    public function make(array $fillings = null) :BaseProduct
    {
        $burger = $this->factory->createBurger();
        $burger->setReceiptFilling($fillings);
        $fillings = new RecieptIterator($burger, $this->visitor);
        foreach ($fillings as $filling) {
            $burger->fillings[] = $filling;
        }
        return $burger;
    }
}