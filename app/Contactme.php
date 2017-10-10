<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactme extends Model
{
    protected $table = "contactme";
    protected $fillable = [
      "name_lastname",
      "email",
      "commentary",
      "ip"
    ];
}
