<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = "post";

    protected $fillable = [
        "id_category",
        "id_user",
        "id_tag",
        "title",
        "image_post",
        "description_title",
        "slug",
        "introduction",
        "content",
        "state"
    ];

}
