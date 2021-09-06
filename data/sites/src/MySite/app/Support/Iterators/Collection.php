<?php

declare(strict_types=1);

namespace MySite\app\Support\Iterators;

use Iterator;
use JetBrains\PhpStorm\Pure;

/**
 * Class Collection
 * @package MySite\app\Support\Iterators
 */
class Collection implements CollectionContract
{
    /**
     * @var array
     */
    private array $items = [];

    /**
     * @param array $items
     */
    public function addItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function addItem($item): void
    {
        $this->items[] = $item;
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function getIterator(): Iterator
    {
        return new CollectionIterator($this);
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function getReverseIterator(): Iterator
    {
        return new CollectionIterator($this, true);
    }

    /**
     * @inheritDoc
     */
    public function collect(array $items): void
    {
        $this->items = $items;
    }

    public function removeItem(mixed $item)
    {
        $this->items = array_filter(
            $this->items,
            fn ($current) => $current !== $item
        );
    }
}
