<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Feed;
use App\Entity\Tweet;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Mikhail Kamorin aka raptor_MVK
 *
 * @copyright 2020, raptor_MVK
 */
final class FeedService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFeed(int $userId, int $count): array
    {
        $feed = $this->getFeedFromRepository($userId);

        return $feed === null ? [] : array_slice($feed->getTweets(), -$count);
    }

    public function putTweet(Tweet $tweet, int $userId): bool
    {
        $feed = $this->getFeedFromRepository($userId);
        if ($feed === null) {
            return false;
        }
        $tweets = $feed->getTweets();
        $tweets[] = $tweet->toFeed();
        $feed->setTweets($tweets);
        $this->entityManager->persist($feed);
        $this->entityManager->flush();

        return true;
    }

    private function getFeedFromRepository(int $userId): ?Feed
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $reader = $userRepository->find($userId);
        if (!($reader instanceof User)) {
            return null;
        }

        $feedRepository = $this->entityManager->getRepository(Feed::class);
        $feed = $feedRepository->findOneBy(['reader' => $reader]);
        if (!($feed instanceof Feed)) {
            $feed = new Feed();
            $feed->setReader($reader);
            $feed->setTweets([]);
        }

        return $feed;
    }
}
