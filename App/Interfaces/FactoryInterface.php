<?php

interface ProductFactory {

    public function createBurger() : Burger;
    public function createSendwich() : Sendwich;
    public function createHotDog() : HotDog;


}

interface Burger {
    public function ProductInformation() : String;
}

interface Sendwich {
    public function ProductInformation() : String;
}

interface HotDog {
    public function ProductInformation() : String;
}