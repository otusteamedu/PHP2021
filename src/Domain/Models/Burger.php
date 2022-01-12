<?php


namespace App\Domain\Models;

use App\Domain\VisitorInterface;

class Burger extends BaseProduct
{
    public $bun = 'Bun';
    public $cutlet = 'Cutlet';

    public function __construct(BaseProduct $prototype = null)
    {
        if ($prototype) {
            $this->bun = $prototype->bun;
            $this->cutlet = $prototype->cutlet;
            $this->setReceiptFilling($prototype->getReceiptFilling());
        }

    }

    public function accept(VisitorInterface $visitor) :void
    {
        $visitor->visitBurger($this);
    }

    public function clone(): ProductPrototypeInterface
    {
        return new Burger($this);
    }

    public function getName(): string
    {
        return 'Бургер';
    }
}