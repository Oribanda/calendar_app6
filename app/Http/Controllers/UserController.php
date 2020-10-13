<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // ログインしているuser
        $users = Auth::user();


        // 取得した値をビュー「user/index」に渡す
        return view('user/index', compact('users'));
    }

    public function create()
    {
        $user = new User();

        return view('user/create', compact('user'));
    }

    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つUserの情報を取得
        $user = User::findOrFail($id);

        // 取得した値をビュー「user/edit」に渡す
        return view('user/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect("/user");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/user");
    }

    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect("user");
    }
}
