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

class UserController extends Controller
{
    public function GetUsers(Request $request)
    {
        $posts = user::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.users.index', ['posts' => $posts]);
    }

    public function DeleteUser($id){
        $post = user::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.users.index')->with('info', 'کاربر فوت شد');
    }

    public function SingleUsers($id){
        $post = user::find($id);
        return view('dashboard.admin.users.single', ['post' => $post, 'id' => $id]);
    }

}