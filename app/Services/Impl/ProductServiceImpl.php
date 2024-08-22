<?php
namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;

class ProductServiceImpl implements ProductService {
    public function get()
    {
        
    }
    public function getAll()
    {
        
    }
    public function add(string $name, string $description, int $price, int $quantity): Product|bool
    {
        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->quantity = $quantity;
        if($product->save()){
            return $product;
        }
        return false;
    }
    public function update()
    {
        
    }
    public function delete()
    {
        
    }
}

?>