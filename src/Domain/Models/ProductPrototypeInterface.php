<?php


namespace App\Domain\Models;


use App\Domain\VisitorInterface;

interface ProductPrototypeInterface
{
    public function __construct(BaseProduct $prototype = null);

    public function getName(): string;

    public function accept(VisitorInterface $visitor) :void;

    public function clone(): ProductPrototypeInterface;
}