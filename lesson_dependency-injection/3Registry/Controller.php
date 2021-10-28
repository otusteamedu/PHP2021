<?php

$registry = new arrayObject();
$registry['grabber'] = new Grabber();
$registry['filter'] = new HtmlExtractor();
$registry['google_finder'] = new GoogleFinder(
    $registry['grabber'],
    $registry['filter']
);

class Controller
{
    private $registry;

    public function __construct(ArrayObject $registry)
    {
        $this->registry = $registry;
    }

    public function action()
    {
        /** @var GoogleFinder $finder */
        $finder = $this->registry['google_finder'];

        $result = $finder->find('search str');
    }
}
