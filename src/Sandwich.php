<?php


namespace App;


class Sandwich extends BaseProduct implements ProductPrototypeInterface
{
    public function accept(VisitorInterfacce $visitor)
    {
        $visitor->visitSandwich($this);
    }
}