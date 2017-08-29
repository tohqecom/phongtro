<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    use \Illuminate\Auth\Authenticatable;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    public function user_logs()
    {
        return $this->hasMany('App\UserLog');
    }


    public function messages()
    {
        return $this->hasMany('App\User');
    }


    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
