<?php
declare(strict_types=1);

namespace App\Infrastructure\Visitor;

use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Iterator\Ingredients\IFastFoodIngredients;

class Report implements IVisitor
{

    public function visitCollection(FastFoodCollection $items): string
    {
        $output = "";

        foreach ($items->getItems() as $employee) {
            $output .= "   " . $this->visitIngredient($employee);
        }

        return $output;
    }


    public function visitIngredient(IFastFoodIngredients $ingredient): string
    {
        return "Ингредиент '".$ingredient->getIngredient()."' добавлен;\n";

    }
}