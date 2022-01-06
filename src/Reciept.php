<?php


namespace App;


class Reciept implements CollectionInterface
{
    private $ingridients = [];

    public function __construct(array $ingridients)
    {
        $this->ingridients = $ingridients;
    }

    public function getIterator()
    {
        return new RecieptIterator();
    }

    public function getItems(): array
    {
        return $this->ingridients;
    }
}