<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator;


use App\Infrastructure\Iterator\FastFoodIterator;
use App\Infrastructure\Visitor\IEntity;
use App\Infrastructure\Visitor\IVisitor;
use Exception;

class FastFoodCollection implements \IteratorAggregate, IEntity
{
    private array $items = [];

    private array $arr = [
        'sausage' => 'Sausage',
        'meat patty' => 'MeatPatty',
        'cheese' => 'Cheese',
        'tomato' => 'Tomato',
        'onion' => 'Onion',
        'salad' => 'Salad',
        'pepperoni' => 'Pepperoni',
        'ketchup' => 'Ketchup',
        'spicy mustard' => 'SpicyMustard',
        'sweet mustard' => 'SweetMustard',
        'mayonnaise' => 'Mayonnaise'
        ];

    public function getItems(): array
    {
        return $this->items;
    }

    public function checkIngredient($item): string
    {
        $className = $this->arr["{$item}"];
        $objectIngredient = "App\\Infrastructure\\Iterator\\Ingredients\\".$className;

        if(!class_exists($objectIngredient)) throw new Exception("Указанный ингредиент {$item} отстутствует\n");
        return $objectIngredient;
    }

    public function addItem($item): void
    {
        $objectIngredient = $this->checkIngredient($item);
        $this->items[] = new $objectIngredient();
    }

    public function getIterator(): \Iterator
    {
        return new FastFoodIterator($this);
    }

    public function accept(IVisitor $visitor): string
    {
        return $visitor->visitCollection($this);
    }
}