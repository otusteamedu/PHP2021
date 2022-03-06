<?php

namespace App\Observer;

use SplObserver;
use SplSubject;

class Cook implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo 'Повару: Приготовить не удалось, готовим заново...<br/>';
    }
}
