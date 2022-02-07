<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator\Ingredients;

use App\Infrastructure\Visitor\IEntity;
use App\Infrastructure\Visitor\IVisitor;

abstract class AbstractFastFoodIngredients implements IEntity, IFastFoodIngredients
{

    abstract public function getIngredient():string;

    public function accept(IVisitor $visitor): string
    {
        return $visitor->visitIngredient($this);
    }
}