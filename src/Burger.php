<?php


namespace App;


class Burger extends BaseProduct implements ProductPrototypeInterface
{
    public function accept(VisitorInterfacce $visitor)
    {
        $visitor->visitBurger($this);
    }
}