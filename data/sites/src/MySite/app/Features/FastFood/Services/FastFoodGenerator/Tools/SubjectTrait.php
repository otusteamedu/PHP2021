<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools;


use MySite\app\Support\Iterators\Collection;
use SplObserver;

/**
 * Trait SubjectTrait
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools
 */
trait SubjectTrait
{

    /**
     * @var Collection
     */
    protected Collection $observers;


    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->addItem($observer);
    }


    /**
     * @param SplObserver $observer
     * @param string $event
     */
    public function detach(SplObserver $observer, string $event = "*")
    {
        $this->observers->removeItem($observer);
    }

    public function notify()
    {
        foreach ($this->observers->getIterator() as $observer) {
            $observer->update($this, $this->getStatus());
        }
    }
}
