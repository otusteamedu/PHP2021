<?php

namespace Otus;

use Otus\App;
use Otus\Check;
use Otus\NotFound;

class Route
{
    private $uri;
    private $page;

    public function __construct($uri) {
    	$this->uri = $uri;
    }

    public function renderPage(): void {
    	switch ($this->uri) {
        case '/':
            $this->page = new App;
            break;
        case '/check':
            $this->page = new Check($_POST['string']);
            break;
        default:
        	 $this->page = new NotFound;
        }

        $this->page->showPage();
    }
}