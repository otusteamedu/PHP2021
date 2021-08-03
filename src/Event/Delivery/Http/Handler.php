<?php

namespace App\Event\Delivery\Http;

use App\App\HttpCore;
use App\Event\UseCase\UseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Phroute\Phroute\RouteCollector;

class Handler
{
    protected UseCase $useCase;

    public function __construct(UseCase $useCase, RouteCollector &$router)
    {
        $this->useCase = $useCase;

        // HttpCoreRequest
        $request = HttpCore::makeRequest();

        $router->post('/event/add', function () use ($request) {
            $response = $this->add($request);
            HttpCore::handleResponse($response);
        });
        $router->get('/event/find-high-priority', function () use ($request) {
            $response = $this->findHighPriorityEvent($request);
            HttpCore::handleResponse($response);
        });
        $router->get('/event/find-all', function () use ($request) {
            $response = $this->findAllEvent($request);
            HttpCore::handleResponse($response);
        });
        $router->get('/event/flush-all', function () use ($request) {
            $response = $this->removeAll();
            HttpCore::handleResponse($response);
        });
    }


    public function add(Request $request): Response
    {
        $data = $request->all('event', 'priority', 'conditions');
        $this->useCase->add($data['priority'], $data['conditions'], $data['event']);
        return new Response('success: add', 200);
    }

    public function findHighPriorityEvent(Request $request): Response
    {
        $conditions = $request->get('conditions');
        $event = $this->useCase->findHighPriorityEvent($conditions);
        return new Response(json_encode($event), 200);
    }

    public function findAllEvent(Request $request): Response
    {
        $conditions = $request->all('conditions');
        $events = $this->useCase->findAllEvent($conditions);
        return new Response(json_encode($events), 200);
    }

    public function removeAll(): Response
    {
        $result = $this->useCase->flush();
        return new Response($result, 200);
    }
}