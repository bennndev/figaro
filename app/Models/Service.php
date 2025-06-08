<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'duration_minutes',
        'price',
    ];
    
    protected $casts = [
        'duration_minutes' => 'integer',
        'price' => 'decimal:2',
    ];
}
