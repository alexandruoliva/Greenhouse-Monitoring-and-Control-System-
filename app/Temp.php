<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $fillable = [


        'id',
        'time',
        'temperature',
        'humidity',
        'created_at',
        'updated_at',

    ];

    public $timestamps=true;
}
