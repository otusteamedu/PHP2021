<?php


use HelloComponent\HelloComponent;

require('vendor/autoload.php');
//require('vendor/dtsarev/hellocomponent/HelloComponent/HelloComponent.php');

$say = new HelloComponent();
$say->sayHello();

//print_r(get_declared_classes());