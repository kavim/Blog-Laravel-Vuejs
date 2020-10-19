<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getPosts()
    {
        $return = \App\Post::where('block', 0)->where('active', 1)->where('deleted', 0)->get();

        \Log::info($return);

        return $return->makeHidden(['id', 'created_at', 'updated_at', 'active', 'block', 'deleted']);
    }

    public function getPost($id)
    {
        $return = [
            'status' => false
        ];

        $post = \App\Post::where('id', $id)->where('block', 0)->where('active', 1)->where('deleted', 0)->first();

        if($post){
            $return = [
                'status' => true,
                'post' => [
                    'title' => $post->title,
                    'subtitle' => $post->subtitle,
                    'content' => $post->content,
                ],
                'cover' => app('App\Http\Controllers\PostController')->getPostCover($post->id),
                'images' => app('App\Http\Controllers\PostController')->getPostImages($post->id)
            ];
        }

        return $return;
    }
}
