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

        $request->validate([
            'title' => ['required', 'max:200'],
            'subtitle' => ['required', 'max:200'],
            'description' => ['required', 'max:200'],
            'postcategory' => ['required'],
            'active' => ['nullable'],
        ]);

        $PostCategory = Post::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'postcategory' => $request->input('postcategory'),
            'active' => $request->active == 1 ? 1 : 0,
            'user_id' => auth()->user()->id,
        ]);

        if($PostCategory){
            return redirect()->route('post.index')->with('msg', 'criado!');
        }

        return redirect()->route('post.index')->with('msg', 'erro!');

        // return redirect()->route('post.index')->with('msg', 'criado!');
    }
}
