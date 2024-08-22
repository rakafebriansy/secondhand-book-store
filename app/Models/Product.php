<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
    ];
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'product_id', 'id');
    }
}
