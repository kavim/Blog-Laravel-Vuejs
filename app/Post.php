<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'content', 'active', 'block', 'deleted', 'order', 'user_id', 'category_id'];

    public function image () {
        return $this->belongsTo(PostImage::class);
    }

    public function cover () {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function category () {
        return $this->belongsToMany(PostCategory::class, 'user_id');
    }
}
