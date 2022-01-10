<?php

namespace App\Domain\Models;

use App\Domain\VisitorInterface;

class HotDog extends BaseProduct implements ProductPrototypeInterface
{
    public $bun;
    public $sausage;

    public function __construct(BaseProduct $prototype = null)
    {
        if ($prototype) {
            $this->bun = $prototype->bun;
            $this->cutlet = $prototype->sausage;
            $this->setReceiptFilling($prototype->getReceiptFilling());
        }

    }

    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitHotDog($this);
    }

    public function clone(): ProductPrototypeInterface
    {
        return new HotDog($this);
    }
}