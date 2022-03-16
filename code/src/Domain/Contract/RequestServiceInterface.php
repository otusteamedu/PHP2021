<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Application\Input\CreateRequestDto;
use App\Application\Output\RequestIsCreatedDto;

interface RequestServiceInterface
{
    public function createRequest(CreateRequestDto $dto):RequestIsCreatedDto;
    public function getStatus(int $idRequest): RequestIsCreatedDto;
}