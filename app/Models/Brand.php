<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'id', 'name', 'desc', 'status'
    ];

    protected $table = 'brands';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
