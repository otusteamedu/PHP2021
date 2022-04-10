<?php

require 'vendor/autoload.php';


$emails_for_test = [
    'kassa@volkovteatr.ru',
    'president@kremlin.ru',
    'bad@not-real.email',
    'bad@vkoontakt.com'
];

/*
 * Вариант 1. Используя статический метод validate
 * Принимает строку или массив email
 */

$staticMethodResult = \Otus\Domain\MXValidator::validate($emails_for_test);

var_dump($staticMethodResult);


/*
 * Вариант 2. Создавать объект валидатора
 * Принимает строку или массив email
 */

$validator = new \Otus\Domain\MXValidator;

$objectMethodResult = $validator->addEmails($emails_for_test)->handle();

var_dump($objectMethodResult);
