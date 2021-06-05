<?php

namespace AppCore\App\Controllers;

use AppCore\Controllers\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends ControllerBase
{
    public function indexAction():Response
    {
        return $this->render('tpl/default.html', ['content' => 'Default action', 'title' => 'Default']);
    }

    public function notFoundAction() :Response
    {
        $response = new Response();
        $response->setContent('404 not found');
        $response->headers->set('Content-Type', 'text/plain');
        $response->setStatusCode(Response::HTTP_NOT_FOUND);
        //return $this->render('tpl/404.html',['content' => "the page does not exists"]);
        return $response;
    }

}