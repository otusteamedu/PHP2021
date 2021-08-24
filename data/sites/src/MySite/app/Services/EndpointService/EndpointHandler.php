<?php

declare(strict_types=1);

namespace MySite\app\Services\EndpointService;


use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use MySite\app\Support\Entities\Endpoint;
use MySite\app\Support\Facades\Schema;

/**
 * Class EndpointHandler
 * @package MySite\app\Services\EndpointService
 */
class EndpointHandler
{

    /**
     * @param Endpoint $endpoint
     * @return int
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveEndpoint(Endpoint $endpoint): int
    {
        $entityManager = Schema::connection();
        $entityManager->persist($endpoint);
        $entityManager->flush();
        return $endpoint->getId();
    }
}
