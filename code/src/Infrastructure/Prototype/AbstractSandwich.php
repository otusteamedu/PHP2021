<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

abstract class AbstractSandwich
{
    abstract function __clone();
}