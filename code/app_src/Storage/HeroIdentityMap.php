<?php

namespace App\Storage;

class HeroIdentityMap
{
    protected $heroObjects;

    public function __construct()
    {
        $this->heroObjects = new \ArrayObject();
    }

    public function set($id, $object)
    {
        $this->heroObjects[$id] = $object;
    }

    public function hasId($id)
    {
        return isset($this->heroObjects[$id]);
    }

    public function getHero($id)
    {
        if ($this->hasId($id) === false) {
            return false;
        }

        return $this->heroObjects[$id];
    }
}
