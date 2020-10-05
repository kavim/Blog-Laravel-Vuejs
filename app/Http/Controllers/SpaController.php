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

        return $return->makeHidden(['id', 'created_at', 'updated_at', 'active', 'block', 'deleted']);
    }
}
