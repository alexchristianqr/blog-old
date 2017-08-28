<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Post extends Model
{

    protected $table = "post";
    protected $fillable = [
        "id",
        "header",
        "body",
        "footer",
        "state",
        "image",
    ];

}
