<?php

use app\UserModel;

require_once('vendor/autoload.php');

$model1 = UserModel::findOne(1);
var_dump($model1);

$model2 = UserModel::findOne(1);
var_dump($model2);

var_dump($model1 === $model2);

$models = UserModel::findAll();
var_dump($models);
