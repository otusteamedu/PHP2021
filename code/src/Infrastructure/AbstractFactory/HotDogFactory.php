<?php
declare(strict_types=1);

namespace App\Infrastructure\AbstractFactory;

use App\Infrastructure\Prototype\AbstractSandwich;
use App\Infrastructure\Prototype\HotDog;

class  HotDogFactory implements IAbstractFactory
{
    public function createSandwich(): AbstractSandwich
    {
        // TODO: Implement createSandwich() method.
        return new HotDog();
    }

}