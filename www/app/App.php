<?php
namespace App;

class App
{
    private $type;
    
    public function __construct(){
        $this->checkData();;
    }
    
    public function run()
    {
        set_time_limit(0);
        ob_implicit_flush();

        $classname = ucfirst($this->type);
        $classname_with_namespace = $this->getPathWithNamespaceFor($classname);

        if(class_exists($classname_with_namespace)){
            $side = new $classname_with_namespace($this->getConfig());
            $side->run();
        }
    }
    
    private function checkData()
    {
        if (empty($_SERVER['argv'][1])){
            throw new \ArgumentCountError('Not enough arguments.');
        }

        if ($_SERVER['argv'][1] === 'client' ||
            $_SERVER['argv'][1] === 'server'){
            $this->type = $_SERVER['argv'][1];  
        } else {
            throw new \InvalidArgumentException('Got unknown type for a socket.');
        }
    }
    
    private function getPathWithNamespaceFor(string $classname): string
    {
        return __NAMESPACE__ . '\\' . $classname .'\\'. $classname;
    }
    
    private function getConfig()
    {
       return new Config(require(__DIR__.'/../config/config.php'));
    }
}