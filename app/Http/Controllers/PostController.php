<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('Editor.post.index');
    }

    public function create()
    {
        return view('Editor.post.create');
    }
}
