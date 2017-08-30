<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $table = 'cars';

    protected $fillable = [
        'brand', 'model', 'productionYear', 'cost','available',
    ];

    public $timestamps = false;
}
