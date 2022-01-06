<?php


namespace App;


interface VisitorInterfacce
{
    public function visitHotDog(HotDog $hotDog);

    public function visitBurger(Burger $burger);

    public function visitSandwich(Sandwich $sandwich);
}