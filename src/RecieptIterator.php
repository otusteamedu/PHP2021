<?php


namespace App;


class RecieptIterator implements \Iterator
{
    private $collection;

    public function __construct(array $collection)
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
        return $this->collection[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid()
    {
        //TODO: Добавить валидацию на проверку является ли элемент ингридиентом
        return isset($this->collection[$this->position]);
    }
}