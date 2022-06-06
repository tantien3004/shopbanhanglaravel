<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 
        'phone', 
        'password',
    ];

    protected $table = 'customers';

    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
