<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.voip.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new post([
            'number' => $request->input('number'),
            'city' => $request->input('number'),
            'benum' => $request->input('benum'),
        ]);

        $post->save();
        return redirect()->route('dashboard.admin.voip.create')->with('info', '  شماره جدید ذخیره شد و نام آن' . $request->input('title'));
    }
}