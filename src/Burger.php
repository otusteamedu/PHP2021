<?php


namespace App;


class Burger extends BaseProduct
{
    public $bun;
    public $cutlet;

    public function __construct(BaseProduct $prototype = null)
    {
        if ($prototype) {
            $this->bun= $prototype->bun;
            $this->cutlet = $prototype->cutlet;
        }
    }

    public function accept(VisitorInterfacce $visitor)
    {
        $visitor->visitBurger($this);
    }

    public function getName()
    {
        return 'name';
    }


    public function clone(): ProductPrototypeInterface
    {
        return new Burger($this);
    }
}