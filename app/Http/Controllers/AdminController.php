<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("Admin.index");
    }

    public function users()
    {
        $users = \App\User::get();

        return view("Admin.user.index", compact('users'));
    }

    public function user_edit($id)
    {
        $user = \App\User::find($id);

        return view("Admin.user.edit", compact('user'));
    }

    public function user_upload(Request $request, $id)
    {
        $user = \App\User::find($id);

        // return view("Admin.user.edit", compact('user'));
    }

}
