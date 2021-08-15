<?php

use Core\View;
use Core\Controller;
use App\Decorator\Features\OnionDecorator;
use App\AbstractFactory\Factories\BurgerFactory;
use App\AbstractFactory\Factories\HotDogFactory;
use App\AbstractFactory\Factories\SendwichFactory;

class Home extends Controller
{

    public function indexAction()
    {
        
        
        //Бургеры
        $burgerFactory = new BurgerFactory();
        $burgerBlackBread = $burgerFactory->createBlackBreadProduct('Гамбургер');
        $burgerWhiteBread = $burgerFactory->createWhiteBreadProduct('Биштейсти');
        
        $OnionDecorator = new OnionDecorator();
        //Бургер с луком 
        $burgerAddOnion = $OnionDecorator->getProduct($burgerBlackBread);

        //Хот доги
        $hotDogFactory = new HotDogFactory();
        $hotDogBlackBread = $hotDogFactory->createBlackBreadProduct('МиниКорн');
        $hotDogWhiteBread = $hotDogFactory->createWhiteBreadProduct('Классический');

        //Сендвичи
        $sendwichFactory = new SendwichFactory();
        $sendwichBlackBread = $sendwichFactory->createWhiteBreadProduct('Итальянский БМТ');
        $sendwichWhiteBread = $sendwichFactory->createWhiteBreadProduct('Датский');


        
        View::renderTemplate('Home/index.html');
    }
    

}