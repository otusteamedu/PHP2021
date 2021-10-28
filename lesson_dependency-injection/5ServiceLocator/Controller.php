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

class Controller
{
    private $container;

    public function __construct(ServiceContainer $container)
    {
        $this->container = $container;
    }

    public function action()
    {
        $finder = $this->container->get('google_finder');

        $result = $finder->find('search str');
    }
}
