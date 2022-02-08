<?php
declare(strict_types=1);

namespace App\Infrastructure\Visitor;

use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Iterator\Ingredients\IFastFoodIngredients;

interface IVisitor
{
    public function visitCollection(FastFoodCollection $items): string;

    public function visitIngredient(IFastFoodIngredients $ingredient): string;

}