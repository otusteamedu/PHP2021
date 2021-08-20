<?php

declare(strict_types=1);

namespace MySite\app\Support\Iterators;


use Closure;
use Iterator;
use JetBrains\PhpStorm\Pure;
use MySite\app\Support\Contracts\CollectionContract;

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
     * @param Closure $fn
     * @return bool
     */
    public function usort(Closure $fn): bool
    {
        return usort(
            $this->items,
            $fn
        );
    }

    /**
     * @param int $int
     * @param int $limit
     * @return Collection
     */
    public function slice(int $int, int $limit): Collection
    {
        $items = $this->items;
        $collection = new self();
        $slice = array_slice($items, $int, $limit);
        $collection->collect($slice);
        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function collect(array $items): void
    {
        $this->items = $items;
    }
}
