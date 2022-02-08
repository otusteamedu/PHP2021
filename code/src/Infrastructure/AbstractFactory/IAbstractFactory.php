<?php
declare(strict_types=1);

namespace App\Infrastructure\AbstractFactory;

use App\Infrastructure\Prototype\AbstractSandwich;

interface IAbstractFactory
{
    public function createSandwich():AbstractSandwich;

}