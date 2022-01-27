<?php
namespace App;

class App
{
    public function run($container)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {
            $checkString = $_POST['string'];
            $container->call(['Src\controller\BracketsController', 'check'], ['checkString' => $checkString]);
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }

}