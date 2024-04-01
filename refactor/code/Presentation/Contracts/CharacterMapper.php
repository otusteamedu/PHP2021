<?php

namespace Presentation\Contracts;

use Domain\Hero;

interface CharacterMapper
{
    public function selectByNickname(string $nickname): Hero;

    public function selectAll(): array;

    public function insert(array $heroData): Hero;

    public function update(array $heroData): array;

    public function deleteById(int $id): bool;
}
