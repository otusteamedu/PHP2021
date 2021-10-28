<?php

$container = new ServiceContainer();

$container['grabber'] = function() {
    return new Grabber();
};

$container['filter'] = function() {
    return new HtmlExtractor();
};

$container['google_finder'] = function() use ($container) {
    return new GoogleFinder(
        $container->get('grabber'),
        $container->get('filter')
    );
};

$container['controller'] = function() use ($container) {
    return new Controller(
        $container->get('google_finder')
    );
};

class Controller
{
    private $finder;

    public function __construct(GoogleFinder $finder)
    {
        $this->finder = $finder;
    }

    public function action()
    {
        $result = $this->finder->find('search str');
    }
}
