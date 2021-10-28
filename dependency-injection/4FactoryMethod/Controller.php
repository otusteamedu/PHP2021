<?php

class Controller
{
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function action()
    {
        $finder = $this->factory->getGoogleFinder();

        $result = $finder->find('search str');
    }
}
