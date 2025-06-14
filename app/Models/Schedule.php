<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = 
    [
        'schedule_date',
        'schedule_time',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'schedule_time' => 'time',
        'start_time' => 'time',
        'end_time' => 'time',
    ];
}
