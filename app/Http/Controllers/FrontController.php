<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Notifications\SignedUp;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Post;
class FrontController extends Controller
{

    public function index() {

        return view('welcome');

    }

    private function escape_like(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }

    public function search(SearchRequest $request)
    {
        $data = $request->validated();
        $numbers = post::orderBy('created_at', 'desc'); 
        if (!empty($data['city']))
            $numbers = $numbers->where('city', $data['city']);
        if (!empty($data['benum']))
            $numbers = $numbers->where('benum', $data['benum']);
        if (!empty($data['number']))
            $numbers = $numbers->where('number', 'LIKE', '%'. $this->escape_like($data['number']) . '%');
        return view('show')->with(['numbers' => $numbers->paginate(12)]);
    }

    public function Cart(Request $request){
        $number=$request->input('number');
        $benum=$request->input('benum');
        $city=$request->input('city');
        return view('cart')->with(['number' => $number ,'benum' => $benum ,'city' => $city]);
    }
    public function payment() {
        
        return view('payment');
    }
    public function pay(Request $data){

        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'father_name' => $data['father_name'],
            'id_code' => $data['id_code'],
            'national_code' => $data['national_code'],
            'birthday' => $data['birthday'],
            'location' => $data['location'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        $user->save();

        return redirect()->route('pay')->with('info', ' شماره جدید ذخیره شدن' );    
    }

}
