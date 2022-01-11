<?php


namespace App\Infrastructure\Iterators;

use App\Domain\Models\BaseProduct;
use App\Domain\VisitorInterface;

class RecieptIterator implements \Iterator
{
    private $collection;
    private $visitor;
    private $product;

    public function __construct(BaseProduct $product, VisitorInterface $visitor)
    {
        $this->product = $product;
        $this->visitor = $visitor;
        $this->collection = $product->getReceiptFilling();
    }

    public function rewind() :void
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

    public function current() :string
    {
        return $this->collection[$this->position];
    }

    public function key() :int
    {
        return $this->position;
    }

    public function next() :void
    {
        $this->product->accept($this->visitor);
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid() :bool
    {
        return isset($this->collection[$this->position]);
    }
}