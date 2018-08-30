<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soil extends Model
{
    protected $fillable = [


        'id',
        'time',
        'moist',
        'updated_at',
        'created_at',
    ];

    public $timestamps=true;
}
