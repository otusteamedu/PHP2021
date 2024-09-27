<?php


namespace AppCore\App;

use AppCore\Configuration\ConfigParser;
use AppCore\Router;
use AppCore\Views\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    public static function run(): void
    {
        $parser = new ConfigParser();
        $request = Request::createFromGlobals();
        $router = Router::getInstance($parser, $request);
        $controller = $router->getControllerName();
        $action = $router->getActionName();
        $oReflController = new \ReflectionClass($controller);
        $view = Renderer::getVew($oReflController, $request);
        $oController = $oReflController->newInstanceArgs(array($view, $request));
        $callable = [$oController, $action . "Action"];
        if (is_callable($callable)) {
            $response = call_user_func_array($callable, []);
            if (!$response instanceof Response) {
                throw new \Exception("The controller $controller must return valid response of type Symfony\\Component\\HttpFoundation\\Response, " . gettype($response) . " given");
            }
            $response->prepare($request);
            $response->send();
        } else {
            throw new \Exception("Action $action is not found in controller $controller");
        }

    }
}