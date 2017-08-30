<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarDetails extends Model
{
    //
    protected $table = 'car_details';

    protected $fillable = [
        'car_id','gearbox','fuel_consumption','engine_capacity','engine_power','fuel','seats'
    ];

    public $timestamps = false;
}
