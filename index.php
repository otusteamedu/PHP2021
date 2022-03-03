<?php

use app\UserModel;

require_once('vendor/autoload.php');

$model = UserModel::findOne(1);

$models = UserModel::findAll();
