<?php


namespace MySite\app\Support\Iterators;


use Iterator;
use JetBrains\PhpStorm\Pure;

interface CollectionContract
{
    /**
     * @param array $items
     * @return void
     */
    public function collect(array $items);

    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @param $item
     * @return void
     */
    public function addItem($item);

    /**
     * @return Iterator
     */
    #[Pure] public function getIterator(): Iterator;

    /**
     * @return Iterator
     */
    #[Pure] public function getReverseIterator(): Iterator;
}
