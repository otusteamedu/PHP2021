<?php
declare(strict_types=1);

namespace App\Infrastructure\Prototype;

abstract class AbstractSandwich
{
    //private array $baseIngredients = [];

    abstract public function getBaseIngredients():array;

    abstract public function setBaseIngredients(array $ingredients):void;

    abstract function getNameProduct(): string;

    abstract public function __clone();

    public function run()
    {
        echo 'ff';
    }
}