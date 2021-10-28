<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Tweet;
use App\Entity\User;
use App\Repository\TweetRepository;
use Doctrine\ORM\EntityManagerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

/**
 * @author Mikhail Kamorin aka raptor_MVK
 *
 * @copyright 2020, raptor_MVK
 */
final class TweetService
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var SubscriptionService */
    private $subscriptionService;
    /** @var FeedService */
    private $feedService;
    /** @var ProducerInterface */
    private $producer;

    public function __construct(EntityManagerInterface $entityManager, SubscriptionService $subscriptionService, FeedService $feedService, ProducerInterface $producer)
    {
        $this->entityManager = $entityManager;
        $this->subscriptionService = $subscriptionService;
        $this->feedService = $feedService;
        $this->producer = $producer;
    }

    private function saveTweet(int $authorId, string $text): ?Tweet
    {
        $tweet = new Tweet();
        $userRepository = $this->entityManager->getRepository(User::class);
        $author = $userRepository->find($authorId);
        if (!($author instanceof User)) {
            return null;
        }
        $tweet->setAuthor($author);
        $tweet->setText($text);
        $this->entityManager->persist($tweet);
        $this->entityManager->flush();

        return $tweet;
    }

    /**
     * @param int[] $authorIds
     *
     * @return Tweet[]
     */
    public function getFeed(array $authorIds, int $count): array {
        /** @var TweetRepository $tweetRepository */
        $tweetRepository = $this->entityManager->getRepository(Tweet::class);

        return $tweetRepository->getByAuthorIds($authorIds, $count);
    }

    public function saveTweetSync(int $authorId, string $text): bool
    {
        $tweet = $this->saveTweet($authorId, $text);

        if ($tweet === null) {
            return false;
        }

        $this->spreadTweet($tweet);

        return true;
    }

    public function saveTweetAsync(int $authorId, string $text): bool
    {
        $tweet = $this->saveTweet($authorId, $text);

        if ($tweet === null) {
            return false;
        }

        $this->producer->publish($tweet->toAMPQMessage());

        return true;
    }

    private function spreadTweet(Tweet $tweet): void
    {
        $followerIds = $this->subscriptionService->getFollowerIds($tweet->getAuthor()->getId());

        foreach ($followerIds as $followerId) {
            $this->feedService->putTweet($tweet, $followerId);
        }
    }
}