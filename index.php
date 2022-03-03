<?php

use app\UserModel;

require_once('vendor/autoload.php');

$model = UserModel::findOne(1);
var_dump($model);

$models = UserModel::findAll();
var_dump($models);
