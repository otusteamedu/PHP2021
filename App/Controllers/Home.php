<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use \App\Factories\BurgerFactory;
use \App\Factories\HotDogFactory;
use \App\Factories\SendwichFactory;

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