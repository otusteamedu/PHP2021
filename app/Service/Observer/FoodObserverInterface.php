<?php

namespace App\Service\Observer;

interface FoodObserverInterface
{
    public function attach(\SplObserver $observer): void;
    public function detach(\SplObserver $observer): void;
    public function notify(): void;

}
