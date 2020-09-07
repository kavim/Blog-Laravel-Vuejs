<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'content', 'active', 'block', 'deleted', 'order', 'user_id', 'category_id'];
}
