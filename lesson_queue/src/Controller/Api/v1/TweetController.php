<?php
declare(strict_types=1);

namespace App\Controller\Api\v1;

use App\Service\SubscriptionService;
use App\Service\TweetService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;

/**
 * @author Mikhail Kamorin aka raptor_MVK
 *
 * @copyright 2020, raptor_MVK
 *
 * @Annotations\Route("/api/v1/tweet")
 */
final class TweetController extends AbstractFOSRestController
{
    /** @var int */
    private const DEFAULT_FEED_SIZE = 20;

    /** @var TweetService */
    private $tweetService;
    /** @var SubscriptionService */
    private $subscriptionService;

    public function __construct(TweetService $tweetService, SubscriptionService $subscriptionService)
    {
        $this->tweetService = $tweetService;
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @Annotations\Post("")
     *
     * @RequestParam(name="authorId", requirements="\d+")
     * @RequestParam(name="text")
     * @RequestParam(name="async", requirements="0|1", nullable=true)
     */
    public function postTweetAction(int $authorId, string $text, ?int $async): View
    {
        $success = $async === 1 ?
            $this->tweetService->saveTweetAsync($authorId, $text) :
            $this->tweetService->saveTweetSync($authorId, $text);
        $code = $success ? 200 : 400;

        return View::create(['success' => $success], $code);
    }

    /**
     * @Annotations\Get("/feed")
     *
     * @QueryParam(name="userId", requirements="\d+")
     * @QueryParam(name="count", requirements="\d+", nullable=true)
     */
    public function getFeedAction(int $userId, ?int $count = null): View
    {
        $count = $count ?? self::DEFAULT_FEED_SIZE;
        $authorIds = $this->subscriptionService->getAuthorIds($userId);
        $tweets = $this->tweetService->getFeed($authorIds, $count);
        $code = empty($tweets) ? 204 : 200;

        return View::create(['tweets' => $tweets], $code);
    }
}