<?php


namespace App;


class RecieptIterator implements \Iterator
{
    private $collection;
    private $visitor;
    private $product;

    public function __construct(BaseProduct $product, VisitorInterfacce $visitor)
    {
        $this->product = $product;
        $this->visitor = $visitor;
        $this->product->accept($this->visitor);
        $this->collection = $product->getReceiptFilling();
    }

    public function rewind()
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

    public function current()
    {
        return $this->collection[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->product->accept($this->visitor);
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid()
    {
        //TODO: Добавить валидацию на проверку является ли элемент ингридиентом
        return isset($this->collection[$this->position]);
    }
}