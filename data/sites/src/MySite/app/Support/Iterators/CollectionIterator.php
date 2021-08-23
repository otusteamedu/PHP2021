<?php

declare(strict_types=1);

namespace MySite\app\Support\Iterators;

use Iterator;
use MySite\app\Support\Contracts\CollectionContract;

/**
 * Class CollectionIterator
 * @package MySite\app\Support\Iterators
 */
class CollectionIterator implements Iterator
{
    /**
     * @var CollectionContract
     */
    private CollectionContract $collection;

    /**
     * @var bool
     */
    private bool $reverse = false;

    /**
     * @var int
     */
    private int $position = 0;

    /**
     * Collection constructor.
     * @param CollectionContract $collection
     * @param bool $reverse
     */
    public function __construct(
        CollectionContract $collection,
        bool $reverse = false
    ) {
        $this->collection = $collection;
        $this->reverse = $reverse;
    }

    public function rewind()
    {
        $this->position = $this->reverse
            ? count($this->collection->getItems()) - 1
            : 0;
    }

    public function current()
    {
        return $this
            ->collection
            ->getItems()[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function valid(): bool
    {
        return isset(
            $this
                ->collection
                ->getItems()[$this->position]
        );
    }
}
