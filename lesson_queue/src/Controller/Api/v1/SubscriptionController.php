<?php
declare(strict_types=1);

namespace App\Controller\Api\v1;

use App\Service\SubscriptionService;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;

/**
 * @author Mikhail Kamorin aka raptor_MVK
 *
 * @copyright 2020, raptor_MVK
 *
 * @Annotations\Route("/api/v1/subscription")
 */
final class SubscriptionController
{
    /** @var SubscriptionService */
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @Annotations\Get("/list-by-author")
     *
     * @QueryParam(name="authorId", requirements="\d+")
     */
    public function listSubscriptionByAuthorAction(int $authorId): View
    {
        $followers = $this->subscriptionService->getFollowers($authorId);
        [$code, $data] = empty($followers) ? [204, ''] : [200, ['followers' => $followers]];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Get("/list-by-follower")
     *
     * @QueryParam(name="followerId", requirements="\d+")
     */
    public function listSubscriptionByFollowerAction(int $followerId): View
    {
        $authors = $this->subscriptionService->getAuthors($followerId);
        [$code, $data] = empty($authors) ? [204, ''] : [200, ['authors' => $authors]];

        return View::create($data, $code);
    }

    /**
     * @Annotations\Post("")
     *
     * @RequestParam(name="authorId", requirements="\d+")
     * @RequestParam(name="followerId", requirements="\d+")
     */
    public function subscribeAction(int $authorId, int $followerId): View
    {
        $success = $this->subscriptionService->subscribe($authorId, $followerId);
        $code = $success ? 200 : 400;

        return View::create(['success' => $success], $code);
    }
}