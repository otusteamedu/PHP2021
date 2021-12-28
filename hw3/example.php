<?php

require __DIR__ . '/vendor/autoload.php';

use OtusPackages\SumCalculator;

$number1 = random_int(1, 10);
$number2 = random_int(1, 10);

$sum = (new SumCalculator())->calc($number1, $number2);

echo "{$number1} + {$number2} = {$sum}" . PHP_EOL;

?>