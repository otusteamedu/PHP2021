<?php

namespace App\Application;

use App\Domain\CinemaSession;
use DateTimeInterface;

interface CinemaSessionRepositoryInterface
{
    /**
     * @return CinemaSession[]
     */
    public function findAll(): array;

    public function findById(int $id): ?CinemaSession;

    public function create(int $movieId, int $screenId, DateTimeInterface $sessionStart): CinemaSession;

    public function update(CinemaSession $session): bool;

    public function delete(CinemaSession $session): bool;
}
