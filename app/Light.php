<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $fillable = [


        'id',
        'time',
        'light',
        'updated_at',
        'created_at',
    ];

    public $timestamps=true;
}
