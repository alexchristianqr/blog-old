<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = "post";

    protected $fillable = [
        "id_user",
        "id_category",
        "id_tag",
        "title",
        "subtitle",
        "description",
        "content",
        "image",
        "images_posts",
        "slug",
        "status",
        "util",
        "inutil",
    ];

}
