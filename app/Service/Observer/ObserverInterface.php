<?php

namespace App\Service\Observer;

use SplSubject;

interface ObserverInterface
{
    public function update(SplSubject $subject);

}
