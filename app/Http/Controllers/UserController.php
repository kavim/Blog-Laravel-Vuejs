<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::find(auth()->user()->id);

        return view("Editor.profile.index", compact('user'));
    }

    public function profile_edit()
    {
        $user = User::find(auth()->user()->id);

        return view("Editor.profile.edit", compact('user'));
    }

    public function profile_update(Request $request)
    {
        \Log::info($request);

        $user = User::find(auth()->user()->id);

        $request->validate([
            'name' => ['required', 'max:100'],
            'lastname' => ['required', 'max:100'],
            'phone' => ['required', 'max:100'],
        ]);

        $ok = $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
        ]);

        if($ok){
            return redirect()->route('profile')->with('msg', 'Atualizado!');
        }

        return redirect()->route('profile.edit')->with('erromsg', 'erro!');
    }
}
