<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\AbstractFactory\HotDogFactory;
use App\Infrastructure\AbstractFactory\IAbstractFactory;
use App\Infrastructure\AbstractFactory\SandwichFactory;
use App\Infrastructure\IHandler;
use App\Infrastructure\Iterator\IteratorProducts;
use App\Infrastructure\Iterator\Products;
use App\Infrastructure\Prototype\AbstractSandwich;
use App\Infrastructure\TestInput;
use App\Infrastructure\EmailValidate;
use App\Infrastructure\RecordMX;


class App
{


    public function __construct()
    {

    }

    public function clientCode(IAbstractFactory $factory):AbstractSandwich
    {
        $sandwich = $factory->createSandwich();
        return clone $sandwich;

    }

    public function run():void
    {
        $userSandwich = $this->clientCode(new HotDogFactory());
        $userSandwich = (new IteratorProducts())->addKetchup()->addOnion();

    }
}