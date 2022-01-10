<?php

namespace App\Domain\Models;

use App\Application\Visitors\VisitorInterface;

class Sandwich extends BaseProduct implements ProductPrototypeInterface
{
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visitSandwich($this);
    }

    public function __construct(BaseProduct $prototype = null)
    {
    }

    public function clone(): ProductPrototypeInterface
    {
        // TODO: Implement clone() method.
    }
}