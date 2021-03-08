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
        return view('dashboard.admin.users.single', ['item' => $post, 'id' => $id]);
    }

    public function UpdateUsers(Request $request)
    {
        $post = user::find($request->input('id'));
        if (!is_null($post)) {
            $post->first_name = $request->input('first_name');
            $post->last_name = $request->input('last_name');
            $post->father_name = $request->input('father_name');
            $post->national_code = $request->input('national_code');
            $post->birthday = $request->input('birthday');
            $post->location = $request->input('location');
            $post->gender = $request->input('gender');
            $post->mobile = $request->input('mobile');
            $post->email = $request->input('email');
            $post->address = $request->input('address');
            $post->internet_service = $request->input('internet_service');
            $post->nationality = $request->input('nationality');
            $post->birthday = $request->input('birthday');
            $post->address = $request->input('address');
            $post->postal_code = $request->input('postal_code');
            $post->save();
        }
        return redirect()->route('dashboard.admin.users.single',$post->id)->with('info', 'شخص ویرایش شد');
    }

}