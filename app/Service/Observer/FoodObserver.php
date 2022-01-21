<?php

namespace App\Service\Observer;

use SplObjectStorage;
use SplSubject;

class FoodObserver implements SplSubject
{
    public $state;
    private $observers;

    public function __construct(string $state)
    {
        $this->observers = new SplObjectStorage();
        $this->state = $state;
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(\SplObserver $observer): void
    {
        echo "Subject: Attached an observer. <br>";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer. <br>";
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify(): void
    {
        echo "Subject: Notifying observers... <br>";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
