<?php

namespace code\Controllers;
use code\Views\Generate_form;
use code\Models\Validation;

class MainController {
    public function run () {
        if (empty($_POST)) {
            $t=(new Generate_form("standart"))->view();
        } else {
            return (new Validation($_POST))->validate();
        }

    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

