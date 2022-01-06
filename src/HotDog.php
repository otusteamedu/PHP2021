<?php


namespace App;


class HotDog extends BaseProduct implements ProductPrototypeInterface
{
    public function accept(VisitorInterfacce $visitor)
    {
        $visitor->visitHotDog($this);
    }
}