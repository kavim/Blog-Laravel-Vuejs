<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image as Imagem;
use Carbon\Carbon;
use Str;

use App\Post;
use App\PostCategory;
use App\PostImage;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->where('deleted', 0)->orderBy('id', 'DESC')->paginate(5);

        return view('Editor.post.index', compact('posts'));
    }

    public function create()
    {
        $post = '';
        $coverSrc = 'background-image: url("'.request()->getSchemeAndHttpHost().'/image/default-cover.png");';
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

        if(count($request->videos)>0){
            foreach ($request->videos as $key => $video) {

                if($video != NULL) {
                    \App\PostVideo::create([
                        'src' => $video,
                        'post_id' => $PostCategory->id
                    ]);
                }

            }
        }

        if($PostCategory){
            return redirect()->route('post.index')->with('msg', 'criado!');
        }

        return redirect()->route('post.index')->with('msg', 'erro!');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $coverSrc = count($post->cover) > 0 ? request()->getSchemeAndHttpHost().'/storage/'.$post->cover[0]->src : request()->getSchemeAndHttpHost().'/image/default-cover.png';
        $coverSrc = 'background-image: url("'.$coverSrc.'");';
        $postCategories = PostCategory::where('user_id', auth()->user()->id)->get();

        // \Log::info(count($post->cover));

        return view('Editor.post.editPost', compact('post', 'postCategories', 'coverSrc'));
    }

    public function update(Request $request, $id)
    {
        \Log::info($request);

        $request->validate([
            'title' => ['required', 'max:200'],
            'subtitle' => ['required', 'max:200'],
            'description' => ['required', 'max:200'],
            'postcategory' => ['required'],
            'active' => ['nullable'],
        ]);

        $PostCategory = Post::find($id);

        $PostCategory->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'category_id' => $request->input('postcategory'),
            'active' => $request->active == 1 ? 1 : 0,
        ]);

        $this->validate($request, ['cover' => 'image|max:20480',]);

        if($request->hasFile('cover')) {
            $src = $request->file('cover')->store("post/image/" . Carbon::now()->format('Y-m-d'), 'public');

            $PostImage = PostImage::where('post_id', $PostCategory->id)->first();

            \Log::info($PostImage);

            if($PostImage){
                $PostImage->update([
                    'name' => Str::slug($PostCategory->title, '-'),
                    'caption' => Str::slug($PostCategory->title, '-'),
                    'src' => $src,
                ]);

                \Log::info("if");
            }else{
                $img = PostImage::create([
                    'name' => Str::slug($PostCategory->title, '-'),
                    'caption' => Str::slug($PostCategory->title, '-'),
                    'src' => $src,
                    'post_id' => $PostCategory->id
                ]);

                \Log::info("else");
            }

            // $image = Imagem::make(storage_path("app/public/".$src))->save();
            $image = Imagem::make(storage_path("app/public/".$src))->fit(1280, 720)->save();
            $image->save();
        }

        \App\PostVideo::where('post_id')->delete();


        if(count($request->videos)>0){
            foreach ($request->videos as $key => $video) {

                if($video != NULL) {
                    \App\PostVideo::create([
                        'src' => $video,
                        'post_id' => $PostCategory->id
                    ]);
                }

            }
        }


        if($PostCategory){
            return redirect()->route('post.index')->with('msg', 'Atualizado!');
        }

        return redirect()->route('post.index')->with('erromsg', 'erro!');
    }

    public function manager($id = null)
    {
        $pid = $id ? $id : 0;

        return view('Editor.post.manager', compact('pid'));
    }

    public function save(Request $request)
    {
        sleep(1);

        \Log::info($request);

        // $vali = $request->validate([
        //     'title' => ['required', 'max:200'],
        //     // 'subtitle' => ['required', 'max:200'],
        //     // 'description' => ['required', 'max:200'],
        //     'postcategory' => ['required'],
        //     'active' => ['nullable'],
        // ]);

        // if($vali){
        //     \Log::info("ok");
        // }

        $response = array('response' => '', 'status'=>false, 'product_id'=>0);

        $validator = Validator::make($request->post,
            [
                'title' => ['required', 'max:200'],
                // 'subtitle' => ['required', 'max:200'],
                // 'description' => ['required', 'max:200'],
                // 'postcategory' => ['required'],
                'active' => ['nullable'],
            ]

            );
            if ($validator->fails()) {
                $response['response'] = $validator->messages();
            }else{

                if($request->post['id'] == 0){
                    $Post = $this->createPost($request->post);
                    if($Post){
                        $response['status'] = true;
                        $response['product_id'] = $Post['id'];
                    }
                }else{
                    $this->updatePost($request->post);
                }


        }
        return $response;


        // return [
        //     'status' => true
        // ];
    }

    public function createPost($post)
    {
        $Post = Post::create([
            'title' => $post['title'],
            'subtitle' => $post['subtitle'],
            'description' => $post['description'],
            'content' => $post['content'],
            'postcategory' => $post['postcategory'],
            'active' => $post['active'] == 1 ? 1 : 0,
            'user_id' => auth()->user()->id,
        ]);

        if($Post){
            return $Post;
        }

        return false;

    }

    public function updatePost($post)
    {
        \Log::info("to update");
    }

    public function saveCover(Request $request)
    {

        \Log::info($request);
        \Log::info(' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ');

        return [
            'status' => true
        ];
    }
    public function saveImages(Request $request)
    {

        \Log::info($request);
        \Log::info(' - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ');

        return [
            'status' => true
        ];
    }

    public function getEditorCats()
    {
        $PostCategory = \App\PostCategory::where('block', 0)->where('deleted', 0)->where('user_id', auth()->user()->id)->get();
        return $PostCategory->makeHidden(['created_at', 'updated_at', 'block', 'deleted']);
    }

    public function getPost($id)
    {
        $PostCategory = \App\PostCategory::where('deleted', 0)->where('user_id', auth()->user()->id)->get();
        return $PostCategory->makeHidden(['created_at', 'updated_at', 'block', 'deleted']);
    }
}
