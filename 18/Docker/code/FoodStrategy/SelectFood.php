<?php

class SelectFood
{
    private SelectFoodInterface $typeFood;

    public function setFoodType(SelectFoodInterface $typeFood){
        $this->typeFood = $typeFood;
    }

    public function execute(){
        return $this->typeFood->makeFood();
    }
}