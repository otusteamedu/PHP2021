<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use \App\BurgerFactory;
use \App\HotDogFactory;
use \App\SendwichFactory;

class Home extends Controller
{

    public function indexAction()
    {
        
        

        // $burgerFactory = new BurgerFactory();
        // $burger = $burgerFactory->makeFood();
        // $burger->getDescription();




        
        View::renderTemplate('Home/index.html');
    }
    

}