<?php

class FoodPublisher implements Observable
{
    private array $observers;
    private Product $product;

    public function __construct(Product $product){
        $this->product = $product;

    }

    public function sendReadyNotify(string $text): void
    {

        $this->notify();
    }

    public function addObserver(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(ObserverInterface $observer)
    {
        foreach ($this->observers as &$search){
            if($search == $observer){
                unset($search);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            /* @var $observer ObserverInterface */
            $observer->handle($this);
        }
    }

}