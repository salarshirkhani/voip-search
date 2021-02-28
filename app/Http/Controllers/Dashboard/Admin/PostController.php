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
            'city' => $request->input('city'),
            'benum' => $request->input('benum'),
            'price' => $request->input('price'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.voip.create')->with('info', ' شماره جدید ذخیره شدن' . $request->input('number'));
    }

    public function GetManagePost(Request $request)
    {
        $posts = post::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.voip.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = post::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.voip.manage')->with('info', 'شماره پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = post::find($id);
        return view('dashboard.admin.voip.updatepost', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = post::find($request->input('id'));
        if (!is_null($post)) {
            $post->number = $request->input('number');
            $post->city = $request->input('city');
            $post->benum = $request->input('benum');
            $post->price = $request->input('price');
            $post->save();
        }
        return redirect()->route('dashboard.admin.voip.updatepost',$post->id)->with('info', 'شماره ویرایش شد');
    }
}