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

    public function getPostById($id)
    {

        $Post = Post::where('id', $id)->where('deleted', 0)->where('user_id', auth()->user()->id)->first();

        // \Log::info("getPostById");
        // \Log::info($Post);

        return $Post->makeHidden(['created_at', 'updated_at', 'block', 'deleted']);

    }

    public function manager($id = null)
    {
        if(!$id){
            $pid = 0;
            return view('Editor.post.manager', compact('pid'));
        }

        // $PostId = Post::where('id', $id)->where('deleted', 0)->where('user_id', auth()->user()->id)->firstOrFail('id');
        $PostId = Post::where('id', $id)->where('deleted', 0)->where('user_id', auth()->user()->id)->first('id');

        if($PostId){

            $pid = $PostId->id;

            return view('Editor.post.manager', compact('pid'));
        }

        return redirect('editor/post');

    }

    public function save(Request $request)
    {
        sleep(1);

        \Log::info($request);

        $response = array('response' => 'Erro', 'status'=>false, 'product_id'=>0);

        $validator = Validator::make($request->post,
            [
                'title' => ['required', 'max:200'],
                // 'subtitle' => ['required', 'max:200'],
                // 'description' => ['required', 'max:200'],
                'category_id' => ['required', 'min:1'],
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
                        $response['response'] = 'created';

                        $this->storeVideos($request->videos, $Post['id']);
                    }

                }else{

                    $PostId = $this->updatePost($request->post);

                    if($PostId){
                        $response['status'] = true;
                        $response['product_id'] = $PostId;
                        $response['response'] = 'updated';

                        $this->updateVideos($request->videos, $PostId);

                        $this->imagesToDelete($request->imagesToDelete, $PostId);

                    }

                }


        }
        return $response;
    }

    public function imagesToDelete($imagesToDelete, $pid)
    {

        \Log::info('imagesToDelete');
        \Log::info($imagesToDelete);
        \Log::info($pid);


        if(!$imagesToDelete){
            return true;
        }

        foreach ($imagesToDelete as $value) {

            \App\PostImage::where('post_id', $pid)->where('id', $value)->delete();

        }
    }

    public function createPost($post)
    {
        $Post = Post::create([
            'title' => $post['title'],
            'subtitle' => $post['subtitle'],
            'description' => $post['description'],
            'content' => $post['content'],
            'category_id' => $post['category_id'],
            'active' => $post['active'] == 1 || $post['active'] ? 1 : 0,
            'user_id' => auth()->user()->id,
        ]);

        if($Post){
            return $Post;
        }

        return false;

    }

    public function storeVideos($videos, $pid)
    {
        \Log::info('storeVideos');

        if(count($videos) > 0){
            foreach ($videos as $key => $video) {

                \App\PostVideo::create([
                    'src' => $video['link'],
                    'post_id' => $pid
                ]);

            }
        }

    }
    public function updateVideos($videos, $pid)
    {
        \App\PostVideo::where('post_id', $pid)->delete();

        if(count($videos) > 0){
            foreach ($videos as $key => $video) {

                \App\PostVideo::create([
                    'src' => $video['link'],
                    'post_id' => $pid
                ]);

            }
        }

    }

    public function updatePost($post)
    {

        $Post = Post::find($post['id']);

        $ok = $Post->update([
            'title' => $post['title'],
            'subtitle' => $post['subtitle'],
            'description' => $post['description'],
            'content' => $post['content'],
            'category_id' => $post['category_id'],
            'active' => $post['active'] == 1 || $post['active'] ? 1 : 0,
        ]);

        if($ok){
            return $Post->id;
        }

        return false;
    }

    public function saveCover(Request $request)
    {

        \Log::info($request);

        $request['data'] = json_decode($request['data']);

        $product_id = $request['data']->productId;

        $this->validate($request, ['cover' => 'image|max:20480',]);

        if($request->hasFile('cover')) {
            $src = $request->file('cover')->store("post/image/" . Carbon::now()->format('Y-m-d'), 'public');
            $img = \App\PostImage::create([
                'name' => 'name',
                'caption' => 'caption',
                'cover' => 1,
                'src' => $src,
                'post_id' => $product_id
            ]);

            // $image = Imagem::make(storage_path("app/public/".$src))->save();
            $image = Imagem::make(storage_path("app/public/".$src))->fit(1280, 720)->save();
            $image->save();
        }

        return [
            'status' => true
        ];
    }
    public function saveImages(Request $request)
    {
        \Log::info($request);

        $request['data'] = json_decode($request['data']);

        $postId = $request['data']->postId;

        // \App\PostImage::where('post_id', $postId)->where('cover', 0)->delete();

        // $this->validate($request, ['cover' => 'image|max:20480',]);

        if($request->hasFile('images')) {


            foreach ($request->file('images') as $key => $value) {

                $src = $value->store("post/image/" . Carbon::now()->format('Y-m-d').rand(1,9999), 'public');

                $img = PostImage::create([
                    'name' => 'name'.rand(1,99999),
                    'caption' => 'caption',
                    'cover' => 0,
                    'src' => $src,
                    'post_id' => $postId
                ]);

                $image = Imagem::make(storage_path("app/public/".$src))->save();
                $image->save();
            }
        }

        return [
            'status' => true
        ];
    }

    public function getEditorCats()
    {
        $PostCategory = \App\PostCategory::where('block', 0)->where('deleted', 0)->where('user_id', auth()->user()->id)->get();
        return $PostCategory->makeHidden(['created_at', 'updated_at', 'block', 'deleted']);
    }

    public function getPostCover($id)
    {
        $return = [
            'status' => false,
            'src'    => '/'
        ];

        $coverSrc = PostImage::where('post_id', $id)->where('cover', 1)->latest()->first();

        if($coverSrc){
            $return['src'] = '/storage/'.$coverSrc->src;
            $return['status'] = true;
        }

        return $return;
    }

    public function getPostImages($id)
    {
        \Log::info('getting post imagens');

        $return = [
            'status' => false,
            'images'    => []
        ];

        $images = array();

        $theimages = PostImage::where('post_id', $id)->where('cover', 0)->get();

        foreach ($theimages as $key => $i) {
            array_push($images, [
                'id' => $i->id,
                'src' => '/storage/'.$i->src
            ]);
        }

        $return['images'] = $images;
        $return['status'] = true;

        \Log::info($return);

        return $return;
    }

    public function getPostVideos($id)
    {
        $videos = array();
        $return = [
            'status' => false,
            'videos'    => []
        ];

        $PostVideos = \App\PostVideo::where('post_id', $id)->get();

        foreach ($PostVideos as $key => $v) {

            array_push($videos, [
                'title' => $v->name,
                'link' => $v->src
            ]);
        }

        if($PostVideos){
            $return['videos'] = $videos;
            $return['status'] = true;
        }

        return $return;
    }
}
