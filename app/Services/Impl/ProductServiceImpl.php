<?php
namespace App\Services\Impl;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;

class ProductServiceImpl implements ProductService {
    public function get()
    {

    }
    public function getPaginate(int $per_page, int $skipped, string $keyword): Collection|bool
    {
        $productsQuery = Product::skip($skipped)->take($per_page);

        if(strlen($keyword) > 0) {
            $productsQuery = $productsQuery->where('name','LIKE','%' . $keyword . '%');
        }

        $products = $productsQuery->get();
        return $products;
    }
    public function getCount(string $keyword): int
    {
        $count = Product::where('name','LIKE','%' . $keyword . '%')->count();
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