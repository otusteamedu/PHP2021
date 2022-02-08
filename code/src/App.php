<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\Strategy\BaseRecipe;
use App\Infrastructure\Strategy\Context;
use App\Infrastructure\Strategy\UserRecipe;
use Exception;

class App
{
    private string $baseProduct;
    private array $arrayIngredients;

    public function __construct(string $baseProduct, array $arrayIngredients)
    {
        $this->baseProduct = $baseProduct;
        $this->arrayIngredients = $arrayIngredients;
    }


    public function run():void
    {
        //Strategy pattern
        $context = new Context($this->baseProduct,$this->arrayIngredients);

        if(!empty($this->arrayIngredients)){
            $context->setStrategy(new UserRecipe());
        }else{
            $context->setStrategy(new BaseRecipe());
        }


        try{
            $context->doSomeBusinessLogic();
        }catch (Exception $e) {
            echo $e->getMessage(). PHP_EOL;
        }

    }
}