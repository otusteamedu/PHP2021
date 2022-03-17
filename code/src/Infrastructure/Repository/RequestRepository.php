<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Input\CreateRequestDto;
use App\Application\Output\RequestIsCreatedDto;
use App\Domain\Contract\RequestFactoryInterface;
use App\Infrastructure\Factory\RequestFactory;
use App\Domain\Contract\RequestRepositoryInterface;
use App\Domain\Contract\RequestServiceInterface;
use App\Domain\Entity\Request;
use phpseclib3\Math\PrimeField\Integer;


class RequestRepository implements RequestRepositoryInterface
{
    private RequestMapper $requestMapper;

    private RequestFactoryInterface $requestFactory;

    public function __construct(){
        $connect = new Config();
        $pdo = $connect->run();

        $this->requestFactory =  new RequestFactory();
        $this->requestMapper = new RequestMapper($pdo);
    }


    public function createRequest(CreateRequestDto $dto): Request
    {
        $request = $this->requestFactory->build(
            $dto::$firstname,
            $dto::$email,
            $dto::$phone,
            $dto::$date1,
            $dto::$date2
        );
        $request->setStatus(false);

        return $this->requestMapper->insert($request);
    }

    public function findRequestById(int $id): Request
    {
        return  $this->requestMapper->findById($id);

    }

    public function findAllRequests(): array
    {
        return  $this->requestMapper->select();

    }

    public function updateStatusRequest(int $id): bool
    {
        return  $this->requestMapper->update($id);

    }

}