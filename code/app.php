<?php

require_once('vendor/autoload.php');

use App\App;

    // ['hot dog','burger','sandwich']
$baseProduct = 'burger';

    /* If $ingredients is empty, the program will select the Basic recipe
    *
    * ['sausage','meat patty','cheese','tomato',
    * 'onion','salad','pepperoni','ketchup',
    * 'spicy mustard','sweet mustard','mayonnaise']
    *
    */
$ingredients = [];

try {
    $app = new App($baseProduct, $ingredients);
    $app->run();

} catch (Exception $e) {
    echo $e->getMessage(). PHP_EOL;
}