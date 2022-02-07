<?php
declare(strict_types=1);

namespace App\Infrastructure\Strategy;

use App\Infrastructure\AbstractFactory\IAbstractFactory;
use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Iterator\FastFoodIterator;
use Exception;

class BaseRecipe extends AbstractStrategy
{

    public function buildProduct(?array $ingredients, IAbstractFactory $factory): void
    {
        //Prototype Pattern
        $baseObjectProduct = $factory->createSandwich();
        $baseIngredients = $baseObjectProduct->getBaseIngredients();

        echo "Готовим '".$baseObjectProduct->getNameProduct()."':\n\n";

        //Iterator Pattern
        $this->runIterator($baseIngredients);
    }
}