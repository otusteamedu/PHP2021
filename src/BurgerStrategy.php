<?php


namespace App;


class BurgerStrategy extends AbstractStrategy
{
    public function make(array $fillings = null)
    {
        $burger = $this->factory->createBurger();
        $fillings = new RecieptIterator($fillings ?? $burger->getReceiptFilling());
        foreach ($fillings as $filling) {
            $burger->fillings[] = $filling;
        }
    }
}