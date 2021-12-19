<?php
namespace App\Observer;

class Products implements \SplSubject
{
   
    public $state;
    
    private $observers;

    public function __construct($stste)
    {   
        $this->state = $stste;
        $this->observers = new \SplObjectStorage();
    }

    
    public function attach(\SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    
    public function action(): void
    {
        $this->notify();
    }
}