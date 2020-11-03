<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostCategory;

use Auth;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postcategories = PostCategory::where('user_id', auth()->user()->id)->get();

        return view('Editor.category.index', compact('postcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategory = '';
        return view('Editor.category.create', compact('postCategory'));
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


        $this->validate($request, [
            'name' => 'string|max:150',
            'block' => 'nullable'
        ]);

        $pc = PostCategory::create([
            'name' => $request->get('name'),
            'user_id' => auth()->user()->id,
            'block' => $request->get('block') ? 1 : 0,
        ]);

        if($pc){
            return redirect()->route('postcategory.index')->with('msg', 'criado!');
        }

        return redirect()->route('postcategory.index')->with('msg', 'erro!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postcategory = PostCategory::find($id);

        if($postcategory->user_id != auth()->user()->id){
            return view('Editor.access_denied');
        }

        if($postcategory){
            return view('Editor.category.edit', compact('postcategory'));
        }

        return redirect()->route('postcategory.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info($request);

        $PostCategory = PostCategory::find($id);

        $this->validate($request, [
            'name' => 'string|max:150',
            'block' => 'nullable'
        ]);

        $pc = $PostCategory->update([
            'name' => $request->get('name'),
            'block' => $request->get('block') ? 1 : 0,
        ]);

        if($pc){
            return redirect()->route('postcategory.index')->with('msg', 'Atualizado!');
        }

        return redirect()->route('postcategory.index')->with('msg', 'erro!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // - - - - - - - - - - - - - - - - - - - - Metodos para Admin - - - - - - - - - - - - - - - - - - - - - - - - -

    public function cat_index()
    {
        $postcategories = PostCategory::get();

        return view('Admin.category.index', compact('postcategories'));
    }


    public function cat_edit($id)
    {
        $postcategory = PostCategory::find($id);

        return view('Admin.category.edit', compact('postcategory'));
    }

    public function cat_create()
    {
        $postcategory = '';

        return view('Admin.category.create', compact('postcategory'));
    }

    public function cat_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|max:150',
            'block' => 'nullable'
        ]);

        $pc = PostCategory::create([
            'name' => $request->get('name'),
            'block' => $request->get('block') ? 1 : 0,
        ]);

        if($pc){
            return redirect()->route('admin.categories')->with('msg', 'Atualizado!');
        }

        return redirect()->route('admin.categories')->with('erro-msg', 'erro!');
    }

    public function cat_update(Request $request, $id)
    {

        $PostCategory = PostCategory::find($request->id);

        $this->validate($request, [
            'name' => 'string|max:150',
            'block' => 'nullable'
        ]);

        $pc = $PostCategory->update([
            'name' => $request->get('name'),
            'block' => $request->get('block') ? 1 : 0,
        ]);

        if($pc){
            return redirect()->route('admin.categories')->with('msg', 'Atualizado!');
        }

        return redirect()->route('admin.categories.edit')->with('erro-msg', 'erro!');
    }

    public function cat_delete($id)
    {

        $cat = PostCategory::find($id);

        \Log::info("eu quero deletar");

        $cat->update([
            'deleted' => 1
        ]);

        $posts = Post::where('category_id', $cat->id)->get();

        foreach($posts as $post){
            $post->update([
                'deleted' => 1
            ]);
        }

    }
}
