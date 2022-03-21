<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Domain\Entity\Request;
use App\Application\Input\CreateRequestDto;

interface RequestRepositoryInterface
{
    public function createRequest(CreateRequestDto $dto): Request;

    public function findRequestById(int $id): ?Request;

    public function findAllRequests(): ?array;
}