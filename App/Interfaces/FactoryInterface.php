<?php

interface ProductFactory {

    /* Продукция с черным хлебом */
    public function createBlackBreadProduct() : BlackBread;

    /* Продукция с белым хлебом */
    public function createWhiteBreadProduct() : WhiteBread;

}

interface Food {
    
    public function getProduct();

}


