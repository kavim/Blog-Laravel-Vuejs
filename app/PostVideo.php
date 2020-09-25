<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    protected $fillable = ['name', 'src', 'caption', 'post_id'];
}
