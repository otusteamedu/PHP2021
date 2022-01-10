<?php

namespace App\Domain\Models;

use App\Application\Visitors\VisitorInterface;

class HotDog extends BaseProduct implements ProductPrototypeInterface
{
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitHotDog($this);
    }

    public function __construct(BaseProduct $prototype = null)
    {
    }

    public function clone(): ProductPrototypeInterface
    {
        // TODO: Implement clone() method.
    }
}