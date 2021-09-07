<?php

namespace Models;
use \Illuminate\Database\Eloquent\Model;


class Product extends Model {
    protected $table = 'products';
    protected $fillable = array('product_name','weight','price');
}