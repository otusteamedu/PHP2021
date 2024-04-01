<?php

namespace Domain;

use Application\Contracts\CharacterIdentityMap;

class HeroIdentityMap implements CharacterIdentityMap
{
    protected $heroObjects;

    public function __construct()
    {
        $this->heroObjects = new \ArrayObject();
    }

    public function set(array $data): void
    {
        $superHeroId = $data['id'];

        unset($data['id']);

        $this->heroObjects[$superHeroId] = $data;
    }

    public function has(int $id): bool
    {
        return isset($this->heroObjects[$id]);
    }
}
