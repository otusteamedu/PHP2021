<?php


namespace App;


class BurgerStrategy extends AbstractStrategy
{
    public function make(RecieptIterator $fillings)
    {
        $burger = $this->factory->createBurger();
        foreach ($fillings as $filling) {
            $burger->fillings[] = $filling;
        }
    }
}