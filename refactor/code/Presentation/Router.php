<?php

namespace Presentation;

use Presentation\Contracts\Routing;

class Router implements Routing
{
    public function getPage(): void
    {
        $page = str_replace('-', '_', str_replace('/', '', $_SERVER['REQUEST_URI']));

        if ($page) {
            $pageFilePath = "pages/$page.php";
            $checkFileExists = file_exists("{$_SERVER['DOCUMENT_ROOT']}/Presentation/$pageFilePath");

            if ($checkFileExists) {
                require_once $pageFilePath;
            } else {
                http_response_code(404);
                require_once 'pages/404.php';
            }
        } else {
            $pageBuilder = new PageBuilder();
            $pageDirector = new PageDirector($pageBuilder);

            $pageDirector->getMainPage();
        }
    }
}
