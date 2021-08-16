<?php
namespace App\Proxy;

use App\Proxy\RealSubject;

class BurgerProxy implements Subject
{
    
    private $realSubject;

    
    public function __construct(Burger $realSubject)
    {
        $this->realSubject = $realSubject;
    }

    
    public function ProductInformation(): void
    {
        if ($this->checkAccess()) {
            $this->realSubject->ProductInformation();
        }
    }

    private function checkAccess(): bool
    {
        if($his->realSubject->weight > 100) return 1;   
    }

}
