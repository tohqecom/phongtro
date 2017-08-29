<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function receiver()
    {
    	return $this->belongsTo('App\User', 'recipient', 'id');
    }


    public function sendBy()
    {
    	return $this->belongsTo('App\User', 'sender', 'id');
    }

    public function post()
    {
    	return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
