<?php

namespace Artemanoshin\Isibia;

class MyLibComposer {

	private string $greeting;
	private string $name;
	
	function __construct(string $greeting, string $name)
	{
		$this->greeting = $greeting;
		$this->name = $name;
	}
	
    public function sayHi()
	{
        echo $this->getGreeting() . ' ' . $this->getName() . PHP_EOL;
    }
	
	public function getGreeting(): string
    {
		return $this->greeting;
	}
	
	public function getName(): string
    {
		return $this->name;
	}
}
