<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = "subscription";
    protected $fillable = [
        "email",
        "remember_token",
        "status"
    ];
}