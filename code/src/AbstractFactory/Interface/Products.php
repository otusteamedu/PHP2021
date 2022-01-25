<?php

namespace App\AbstractFactory\Interface;

// Интерфейс для продуктов
interface Products {

    public function CreateBurger(int $cookingStage) : Burger;
    public function CreateSandwich(int $cookingStage) : Sandwich;
    
}
