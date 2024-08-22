<?php
namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;

class ProductServiceImpl implements ProductService {
    public function get()
    {

    }
    public function getPaginate(int $per_page, int $skipped): Collection|bool
    {
        $products = Product::skip($skipped)->take($per_page)->get();
        return $products;
    }
    public function getCount(): int
    {
        $count = Product::count();
        return $count;
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