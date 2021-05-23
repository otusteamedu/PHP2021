<?

namespace App;

use Core\Router;

class App {
    
    public function run(){

        $router = new Router();

        
        $router->add('', ['controller' => 'Home', 'action' => 'index']);
        $router->add('messages', ['controller' => 'Messages', 'action' => 'index']);
        $router->add('{controller}/{action}');
        
        $router->dispatch($_SERVER['QUERY_STRING']);

          

    }

}