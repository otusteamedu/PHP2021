<?php
namespace code\Views;
Class Generate_form {
    protected $html='';
    public function __construct($type) {
        if ($type=="standart") {
            $this->html='<form method="POST">
                <input type="text" name="String">
                <input type="submit">
                </form>';
        }
    }
    public function view() {
        echo $this->html;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

