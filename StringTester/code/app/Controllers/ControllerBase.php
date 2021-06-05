<?php


namespace AppCore\Controllers;

use AppCore\Views\ViewBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerBase implements ControllerInterface
{
    protected ViewBase $view;
    protected Request $request;
    public function __construct(ViewBase $view, Request $request)
    {
        $this->view = $view;
        $this->request = $request;
    }

    protected function render($tplFile, $variables):Response {
        $result = $this->view->renderView($tplFile, $variables);
        $response = new Response();
        $response->setContent($result);
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }

}