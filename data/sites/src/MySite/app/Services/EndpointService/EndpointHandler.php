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

    /**
     * @return array
     */
    public function getAll(): array
    {
        $entityManager = Schema::connection();
        $repository = $entityManager->getRepository(Endpoint::class);
        $endpoints = $repository->findAll();
        return $this->prepareArray($endpoints);
    }

    /**
     * @param array $endpoints
     * @return array
     */
    private function prepareArray(array $endpoints): array
    {
        $result = [];
        array_walk(
            $endpoints,
            static function (Endpoint $endpoint) use (&$result) {
                $result[] = [
                    'id' => $endpoint->getId(),
                    'http_referer' => $endpoint->getHttpReferer(),
                    'query_string' => $endpoint->getQueryString(),
                    'redirected_query_string' => $endpoint->getRedirectedQueryString(),
                    'user_ip' => $endpoint->getUserIp(),
                    'user_agent' => $endpoint->getUserAgent(),
                    'is_checked' => $endpoint->isChecked(),
                    'created_at' => $endpoint->getCreatedAt()
                ];
            }
        );
        return $result;
    }
}
