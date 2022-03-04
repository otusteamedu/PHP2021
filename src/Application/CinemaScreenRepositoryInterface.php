<?php

namespace App\Application;

use App\Domain\CinemaScreen;

interface CinemaScreenRepositoryInterface
{
    /**
     * @return CinemaScreen[]
     */
    public function findAll(): array;

    public function findById(int $id): ?CinemaScreen;

    public function create(int $id, string $name, int $maxSeats): CinemaScreen;

    public function update(CinemaScreen $screen): bool;

    public function delete(CinemaScreen $screen): bool;
}
