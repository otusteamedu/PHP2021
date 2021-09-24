<?php

namespace HW9\YouTube\Channel;

use Countable;
use Iterator;

class ChannelList implements Countable, Iterator
{
    public $items = [];
    protected $counter;

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function remove($item)
    {
        $id_to_remove = $item->getId();
        $this->items = array_filter($this->items, function ($item) use ($id_to_remove) {
            return $item->getId() !== $id_to_remove;
        });
    }

    public function initFromArray(array $list) : void
    {
        foreach ($list as $link) {
            $channel = new Channel($link);
            $this->add($channel);
        }
    }

    public function current()
    {
        return $this->items[$this->counter];
    }

    public function next()
    {
        $this->counter++;
    }

    public function key()
    {
        return $this->counter;
    }

    public function valid()
    {
        return isset($this->items[$this->counter]);
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function count() : int
    {
        return count($this->items);
    }
}
