<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'content', 'active', 'block', 'deleted', 'order', 'user_id', 'category_id'];

    public function image () {
        return $this->belongsTo(PostImage::class);
    }

    public function video () {
        return $this->hasMany(PostVideo::class, 'post_id');
    }

    public function cover () {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function category () {
        return $this->belongsToMany(PostCategory::class, 'user_id');
    }

    public function getCover($id)
    {
        $cover = PostImage::where('post_id', $id)->first();

        return $cover ? '/storage/'.$cover->src : '/image/default-cover.png';
    }
}
