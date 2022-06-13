<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'user_id', 'product_id', 'quantity', 'created_at', 'updated_at'
    ];

    protected $table = 'carts';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
