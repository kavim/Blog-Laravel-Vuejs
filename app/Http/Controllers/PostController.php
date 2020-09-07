<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->where('deleted', 0)->get();

        return view('Editor.post.index', compact('posts'));
    }

    public function create()
    {
        $post = '';
        $postCategories = PostCategory::where('user_id', auth()->user()->id)->get();
        return view('Editor.post.create', compact('post', 'postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request);
        echo 'ok';

        // if($pc){
        //     return redirect()->route('postcategory.index')->with('msg', 'criado!');
        // }

        // return redirect()->route('postcategory.index')->with('msg', 'erro!');

        return redirect()->route('post.index')->with('msg', 'criado!');
    }
}
