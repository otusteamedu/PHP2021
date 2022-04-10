<?php

namespace App\Observer;

use SplObserver;
use SplSubject;

class Customer implements SplObserver
{
	public function update(SplSubject $subject): void
	{
		echo ($subject->getStatus() . PHP_EOL);
	}
}