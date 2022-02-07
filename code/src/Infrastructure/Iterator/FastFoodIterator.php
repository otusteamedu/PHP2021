<?php
declare(strict_types=1);

namespace App\Infrastructure\Iterator;

use App\Infrastructure\Iterator\FastFoodCollection;
use App\Infrastructure\Visitor\IVisitor;

class FastFoodIterator implements \Iterator
{
    private FastFoodCollection $collection;

    private int $position = 0;

    private bool $reverse = false;

    public function __construct(FastFoodCollection $collection)
    {
        $this->collection = $collection;
    }

    public function rewind()
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

    public function current()
    {
        return $this->collection->getItems()[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid(): bool
    {
        return isset($this->collection->getItems()[$this->position]);
    }
}