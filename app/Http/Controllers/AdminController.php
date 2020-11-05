<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view("Admin.index");
    }

    public function users()
    {
        \Log::info("users()");
        $users = \App\User::get();

        \Log::info($users);

        return view("Admin.user.index", compact('users'));
    }

    public function user_edit($id)
    {
        if($id == 3){
            return view("Admin.errorPage");
        }

        $user = \App\User::find($id);

        $userTypes = \App\UserType::get();

        return view("Admin.user.edit", compact('user', 'userTypes'));
    }

    public function user_create()
    {
        $user = '';

        $userTypes = \App\UserType::get();

        return view("Admin.user.create", compact('user', 'userTypes'));
    }

    public function user_store(Request $request)
    {
        \Log::info($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'email' => 'required|email',
            'lastname' => 'required',
            'phone' => 'max:50',
            'user_type_id' => 'required|numeric',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/user/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        \App\User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'block' => $request->block ? 1 : 0,
            'user_type_id' => $request->user_type_id,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.user.create')->with('msg', 'Atualizado');
    }

    public function user_update(Request $request, $id)
    {

        \Log::info($request);

        $user = \App\User::find($id);

        if($id == 3){
            return view("Admin.errorPage");
        }

        $validator = Validator::make($request->all(), [
            // 'name' => 'required|unique:posts|max:255',
            'name' => 'required|max:200',
            'lastname' => 'required',
            'phone' => 'max:50',
            'user_type_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('admin/user/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'block' => $request->block ? 1 : 0,
            'user_type_id' => $request->user_type_id,
        ]);

        if($request->password != null){
            if (Hash::make($request->adminpassword) === auth()->user()->password && auth()->user()->user_type_id == 3) {

                \Log::info("ok para trocar senha");

                $user->update(['password' => Hash::make($request->password)]);

            }else{
                return redirect()->route('admin.user.edit')->with('erro-msg', 'Erro ao atualizar senha');
            }

        }

        return redirect()->route('admin.user.edit', $id)->with('msg', 'Atualizado');
    }

}
