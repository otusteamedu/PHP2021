<?php
declare(strict_types=1);

namespace App\Infrastructure\Strategy;

use App\Infrastructure\AbstractFactory\IAbstractFactory;
use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Visitor\Report;
use Exception;

abstract class AbstractStrategy
{
    abstract public function buildProduct(array $ingredients, IAbstractFactory $factory):void;

    public function runIterator($baseIngredients){
        //Iterator Pattern
        $collection  = new FastFoodCollection();
        try {
            foreach ($baseIngredients as $item) {
                $collection->addItem($item);
            }
        }catch (Exception $e) {
            echo $e->getMessage(). PHP_EOL;
        }

        //Visitor Pattern
        $reportVisitor = new Report();

        foreach ($collection->getIterator() as $item) {
            echo $item->accept($reportVisitor);
        }

        echo PHP_EOL;
    }
}