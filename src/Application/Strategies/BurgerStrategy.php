<?php


namespace App\Application\Strategies;


use App\Application\Visitors\Visitor;
use App\Infrastructure\Iterators\RecieptIterator;

class BurgerStrategy extends AbstractStrategy
{
    public function make(array $fillings = null)
    {
        $burger = $this->factory->createBurger();
        $burger->setReceiptFilling($fillings);
        $fillings = new RecieptIterator($burger, new Visitor());
        foreach ($fillings as $filling) {
            $burger->fillings[] = $filling;
        }
    }
}