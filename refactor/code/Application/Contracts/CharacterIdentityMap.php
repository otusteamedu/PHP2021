<?php

namespace Application\Contracts;

interface CharacterIdentityMap
{
    public function set(array $data) : void;

    public function has(int $id) : bool;
}
