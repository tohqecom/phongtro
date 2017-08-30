<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    //
    protected $table = "rents";

    protected $fillable = [
        'user_id','car_id','date_start', 'date_end','paid','old'
    ];

    public $timestamps = false;
}
