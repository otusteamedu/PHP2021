<?php
namespace Controllers;
use Models\Product;
use Controller\ProductOptions;

class Users {

    private $productOption = null;

    public function getOneProduc(int $id){
        return Product::where('id', $id)->get();
    }

    public function addProduct(String $productName, Int $weight, Int $price){
        $product = new Product([
            'product_name' => $productName,
            'weight' => $weight,
            'price' => $price
        ]);

        return $product->save();

    }

    public function updateProduct(Int $id, String $productName, Int $weight, Int $price){
        
        $product = Product::find($id);
        $product->producnt_name = $productName;
        $product->weight = $weight;
        $product->price = $price;
        
        $product->save();

    }

    public function deleteProduct(Int $id){

        $product = Product::find($id);
        return $product->delete();

    }

    public  function getProductOptions(Int $id) : Array
    {
        if(is_null($this->productOption)){
            $this->productOption = ProductOptions::getOptions($id);
        }

        return $this->productOption;
    }
} 