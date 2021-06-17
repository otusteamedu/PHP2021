<?php

return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/events/create', 'Server\Event\Endpoint\HttpHandler::create');
    $r->addRoute('POST', '/events/findOne', 'Server\Event\Endpoint\HttpHandler::findOneByConditionsWithHighestScore');
    $r->addRoute('POST', '/events/findAll', 'Server\Event\Endpoint\HttpHandler::findAllByConditions');
    $r->addRoute('POST', '/events/deleteAll', 'Server\Event\Endpoint\HttpHandler::deleteAllEventsByConditions');
    $r->addRoute('POST', '/events/deleteOne', 'Server\Event\Endpoint\HttpHandler::deleteOneEvent');
    $r->addRoute('POST', '/events/flush', 'Server\Event\Endpoint\HttpHandler::flush');
});
