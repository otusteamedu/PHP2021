<?php 

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Databse {
    public function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
              "driver" => "",
              "host" => "",
              "database" => "",
              "username" => "",
              "password" => "",
              "charset" => "utf8",
              "collation" => "utf8_unicode_ci",
              "prefix" => "",
        ]);
        
        $capsule->bootEloquent();
    }
}