<?php
declare(strict_types=1);

namespace App\Infrastructure\Strategy;

use App\Infrastructure\AbstractFactory\IAbstractFactory;
use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Iterator\FastFoodIterator;
use Exception;

class UserRecipe extends AbstractStrategy
{

    public function buildProduct(IAbstractFactory $factory, array $ingredients): void
    {
        //Prototype Pattern
        $userObjectProduct = clone $factory->createSandwich();

        $userObjectProduct->setBaseIngredients($ingredients);
        $baseIngredients = $userObjectProduct->getBaseIngredients();

        echo "Готовим '".$userObjectProduct->getNameProduct()."':\n";

        //Iterator Pattern
        $this->runIterator($baseIngredients);


    }


}