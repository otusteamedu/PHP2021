<?php

namespace App\Domain\Models;

use App\Domain\VisitorInterface;

class Sandwich extends BaseProduct
{
    public $bun = 'Bun';
    public $cheese = 'Cheese';

    public function __construct(BaseProduct $prototype = null)
    {
        if ($prototype) {
            $this->bun = $prototype->bun;
            $this->cutlet = $prototype->cheese;
            $this->setReceiptFilling($prototype->getReceiptFilling());
        }

    }

    public function accept(VisitorInterface $visitor) :void
    {
        $visitor->visitSandwich($this);
    }

    public function clone(): ProductPrototypeInterface
    {
        return new Sandwich($this);
    }

    public function getName(): string
    {
        return 'Сэндвич';
    }
}