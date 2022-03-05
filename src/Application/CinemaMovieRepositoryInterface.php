<?php

namespace App\Application;

use App\Domain\CinemaMovie;

interface CinemaMovieRepositoryInterface
{
    /**
     * @return CinemaMovie[]
     */
    public function findAll(): array;

    public function findById(int $id): ?CinemaMovie;

    public function create(string $nameOriginal, ?string $nameLoc, int $durationMin): CinemaMovie;

    public function update(CinemaMovie $movie): bool;

    public function delete(CinemaMovie $movie): bool;
}
