<?php

namespace App\Services;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
interface ProductService {
    function get();
    function getPaginate(int $per_page, int $skipped, string $keyword): Collection|bool;  
    function getCount(string $keyword): int;
    function add(array $data): Product|bool;
    function update(array $data): Product|bool;
    function delete(); 
}

?>