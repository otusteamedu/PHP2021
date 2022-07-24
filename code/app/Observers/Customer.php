<?php

namespace App\Observer;

use SplSubject;

class Customer implements \SplObserver
{

    /**
     * @param SplSubject $subject
     * @return void
     */
    public function update(SplSubject $subject): void
    {
        echo $subject->getStatus();
    }
}