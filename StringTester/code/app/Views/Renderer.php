<?php


namespace AppCore\Views;


use Symfony\Component\HttpFoundation\Request;

/**
 * Class Renderer
 * @package AppCore\Views
 */
class Renderer
{
    /**
     * @param \ReflectionClass $controller
     * @param Request $request
     * @return ViewBase
     */
    public static function getVew(\ReflectionClass $controller, Request $request) : ViewBase {
        $docRoot =  $request->server->get('DOCUMENT_ROOT');
        $controllerFileName  = trim(str_replace($docRoot,"",$controller->getFileName()), "/");
        //configure directories
        $pathPart = explode('Controllers', $controllerFileName);
        $viewCoreTplPath = str_replace($docRoot,"",__DIR__ . "/tpl");
        $viewCoreTplPath = trim($viewCoreTplPath, "/");
        $viewFeatureTplPath = trim($pathPart[0], "/");
        return new ViewBase($viewCoreTplPath, $viewFeatureTplPath);
    }

}