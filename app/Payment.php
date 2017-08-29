<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    public function member()
    {
    	return $this->belongsTo('App\User','user_id', 'id');
    }
}
