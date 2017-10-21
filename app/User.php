<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id_type_user',
        'id_provider',
        'id_sector',
        'age',
        'country',
        'observation',
        'name',
        'lastname',
        'nick',
        'email',
        'image',
        'password',
        'unpassword',
        'avatar',
        'provider',
        'status',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
