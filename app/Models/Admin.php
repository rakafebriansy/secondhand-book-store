<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $guard = 'admin';
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'admin_id', 'id');
    }
}
