<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Input\CreateRequestDto;
use App\Application\Output\RequestIsCreatedDto;
use App\Domain\Contract\RequestRepositoryInterface;
use App\Domain\Contract\RequestServiceInterface;
use App\Domain\Entity\Request;

class RequestService  implements RequestServiceInterface
{
    private RequestRepositoryInterface $requestRepository;


    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;

    }

    public function createRequest(CreateRequestDto $dto):RequestIsCreatedDto
    {
        $request = $this->requestRepository->createRequest($dto);
        $response = new RequestIsCreatedDto();
        $response->id = $request->getId();

        return $response;
    }

    public function getStatus(int $idRequest): RequestIsCreatedDto
    {
        $request = $this->requestRepository->findRequestById($idRequest);
        $response = new RequestIsCreatedDto();
        $response->status = $request->getStatus();
        
        return $response;
    }

}