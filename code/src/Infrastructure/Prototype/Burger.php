<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

class Burger extends AbstractSandwich
{
    public AbstractSandwich $prototype;

    public function __clone()
    {
    }
}