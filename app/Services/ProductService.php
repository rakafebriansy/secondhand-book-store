<?php

namespace App\Services;
use App\Models\Product;
interface ProductService {
    function get(); 
    function getAll(); 
    function add(string $name, string $description, int $price, int $quantity): Product|bool;
    function update(); 
    function delete(); 
}

?>