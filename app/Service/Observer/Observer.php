<?php

namespace App\Service\Observer;

use SplObserver;
use SplSubject;

class Observer implements SplObserver
{

    /**
     * @inheritDoc
     */
    public function update(SplSubject $subject)
    {
        switch ($subject->state){
            case 'start':
                echo 'Start cooking <br>';
                break;
            case 'end':
                echo 'End cooking <br>';
                break;
        }
    }
}
