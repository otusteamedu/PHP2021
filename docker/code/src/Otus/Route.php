<?php

namespace Otus;

use Otus\App;
use Otus\View;
use Otus\Check;
use Otus\NotFound;

class Route
{
    private $uri;
    private $view;

    public function __construct($uri) {
    	$this->uri = $uri;
    }

    public function renderPage(): void {
    	switch ($this->uri) {
        case '/':
            $page = new App;
            $this->view = new View($page->template());
            break;
        case '/check':
            $page = new Check($_POST['string']);
            $this->view = new View($page->template(), $page->params());
            break;
        default:
        	 $this->page = new NotFound;
        }

        $this->view->render();
    }
}