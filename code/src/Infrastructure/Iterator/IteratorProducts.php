<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator;

use App\Infrastructure\Prototype\AbstractSandwich;

class IteratorProducts implements \Iterator
{
    private bool $cheese = false;
    private bool $onion = false;
    private bool $salad = false;
    private bool $tomato = false;
    private bool $pepperoni = false;
    private bool $ketchup = false;
    private bool $spicyMustard = false;
    private bool $sweetMustard = false;
    private bool $mayonnaise = false;

    private AbstractSandwich $prototype;

    public function __construct(AbstractSandwich $prototype){
        $this->prototype = $prototype;
    }

    public function addCheese():IteratorProducts
    {
        $this->cheese = true;
        return $this;
    }

    public function addOnion():IteratorProducts
    {
        $this->onion = true;
        return $this;
    }

    public function addSalad():IteratorProducts
    {
        $this->salad = true;
        return $this;
    }

    public function addTomato():IteratorProducts
    {
        $this->tomato = true;
        return $this;
    }

    public function addPepperoni():IteratorProducts
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addKetchup():IteratorProducts
    {
        $this->ketchup = true;
        return $this;
    }

    public function addSpicyMustard():IteratorProducts
    {
        $this->spicyMustard = true;
        return $this;
    }

    public function addSweetMustard():IteratorProducts
    {
        $this->sweetMustard = true;
        return $this;
    }

    public function addMayonnaise():IteratorProducts
    {
        $this->mayonnaise = true;
        return $this;
    }
    /**
     * @inheritDoc
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}