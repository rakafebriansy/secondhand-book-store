<?php

namespace App\Services;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
interface ProductService {
    function get();
    function getPaginate(int $per_page, int $skipped): Collection|bool;  
    function getCount(): int;
    function add(string $name, string $description, int $price, int $quantity): Product|bool;
    function update(); 
    function delete(); 
}

?>