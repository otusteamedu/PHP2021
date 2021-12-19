<?php

namespace App\AbstractFactory\Interface;

// Интерфейс для продуктов
interface Products {

    public function CreateBurger(int $standard) : Burger;
    public function CreateSandwich(int $standard) : Sandwich;
    
}
