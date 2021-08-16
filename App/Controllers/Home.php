<?php
namespace App\Controllers;

use Core\View;
use Core\Controller;
use App\Observers\Subject;
use App\Decorator\Features\OnionBurgerDecorator;
use App\AbstractFactory\Factories\BlackBreadProducts;

class Home extends Controller
{

    public function indexAction()
    {
        
        $BlackBreadProducts = new BlackBreadProducts();
        
        $BlackBreadBurger = $BlackBreadProducts->createBurger(100);
        $BlackBreadSendwich = $BlackBreadProducts->createSendwich(80);
        $BlackBreadHotDog = $BlackBreadProducts->createHotDog(150);

        $BlackBreadBurgerOnion = new OnionBurgerDecorator($BlackBreadBurger);
        

        $subject = new Subject(1);
        $o1 = new ConcreteObserverA();
        $subject->attach($o1);
        $subject->someBusinessLogic();

        
        

        
        View::renderTemplate('Home/index.html');
    }
    

}