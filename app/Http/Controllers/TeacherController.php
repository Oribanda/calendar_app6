<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Teacher;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{
    public function index()
    {
        // $teachers = Teacher::all(); // index.bladeで[0]と指定する事でid1のデータは取得できるが、他のteacherでログインしてもid1を取得してしまう。[0]を外すとエラーが出る。
        // $teachers = Auth::teacher();
        // var_dump(Auth::User());
        // var_dump(Auth::Teacher());

        return view('teacher/index');
        // return view('teacher/index', compact('teachers')); // $teachers = Teacher::all();で使える。
    }

    public function create()
    {
        $teacher = new Teacher();

        return view('teacher/create', compact('teacher'));
    }

    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つTeacherの情報を取得
        $teacher = Teacher::findOrFail($id);

        // 取得した値をビュー「teacher/edit」に渡す
        return view('teacher/edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {


        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = $request->password;
        $teacher->save();

        return redirect("/teacher");
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect("/teacher");
    }

    public function store(Request $request)
    {

        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = $request->password;

        $teacher->save();

        return redirect("teacher");
    }

}
