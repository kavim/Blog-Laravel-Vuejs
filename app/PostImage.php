<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = ['name', 'src', 'caption', 'cover', 'post_id'];
}
