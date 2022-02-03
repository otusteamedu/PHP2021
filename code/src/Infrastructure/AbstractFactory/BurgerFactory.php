<?php
declare(strict_types=1);

namespace App\Infrastructure\AbstractFactory;

use App\Infrastructure\Prototype\AbstractSandwich;
use App\Infrastructure\Prototype\Burger;

class BurgerFactory implements IAbstractFactory
{
    public function createSandwich(): AbstractSandwich
    {
        // TODO: Implement createSandwich() method.
        return new Burger();
    }
}