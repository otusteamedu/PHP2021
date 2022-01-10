<?php


namespace App;


class Visitor implements VisitorInterfacce
{
    public function visitHotDog(HotDog $hotDog)
    {

    }

    public function visitBurger(Burger $burger)
    {
        echo 'Ингридиенты бургера: ' . implode(', ', $burger->fillings) . '<br>';
    }

    public function visitSandwich(Sandwich $sandwich)
    {

    }
}