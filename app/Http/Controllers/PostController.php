<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image as Imagem;
use Carbon\Carbon;
use Str;

use App\Post;
use App\PostCategory;
use App\PostImage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->where('deleted', 0)->get();

        return view('Editor.post.index', compact('posts'));

        // return $posts;
    }

    public function create()
    {
        $post = '';
        $coverSrc = 'background-image: url("'.request()->getSchemeAndHttpHost().'/image/default-cover.png");';;
        $postCategories = PostCategory::where('user_id', auth()->user()->id)->get();
        return view('Editor.post.create', compact('post', 'postCategories', 'coverSrc'));
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


        $this->validate($request, ['cover' => 'image|max:20480',]);

        if($request->hasFile('cover')) {
            $src = $request->file('cover')->store("post/image/" . Carbon::now()->format('Y-m-d'), 'public');
            $img = PostImage::create([
                'name' => Str::slug($PostCategory->title, '-'),
                'caption' => Str::slug($PostCategory->title, '-'),
                'src' => $src,
                'post_id' => $PostCategory->id
            ]);

            // $image = Imagem::make(storage_path("app/public/".$src))->save();
            $image = Imagem::make(storage_path("app/public/".$src))->fit(1280, 720)->save();
            $image->save();
        }

        if($PostCategory){
            return redirect()->route('post.index')->with('msg', 'criado!');
        }

        return redirect()->route('post.index')->with('msg', 'erro!');

        // return redirect()->route('post.index')->with('msg', 'criado!');
    }

    public function edit($id)
    {

        // enviar junto a img
        //  $src = auth()->user()->post->image->src != null ? auth()->user()->seller->basic_settings->cover : Auth::user()->seller->seller_type->background;

        // $opa = 'background-image: url("'.request()->getSchemeAndHttpHost().'/storage/'.$src.'");';

    }
}
