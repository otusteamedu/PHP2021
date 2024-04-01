<?php

namespace App\Storage;

class HeroIdentityMap
{
    protected $heroObjects;

    public function __construct()
    {
        $this->heroObjects = new \ArrayObject();
    }

    public function set($object)
    {
        $superHeroId = $object['id'];

        unset($object['id']);

        $this->heroObjects[$superHeroId] = $object;
    }

    public function hasHero($id)
    {
        return isset($this->heroObjects);
    }
}
