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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
        if (!empty($data['benum'])){
            $numbers = $numbers->where('benum', $data['benum']);}
        if (!empty($data['city'])){
            $numbers = $numbers->where('city', $data['city']);}
        if (!empty($data['number'])){
            $numbers = $numbers->where('number', 'LIKE', '%'. $this->escape_like($data['number']) . '%');}
        return view('show')->with(['numbers' => $numbers->paginate(12)]);
    }

    public function Cart(Request $request){
        $number=$request->input('number');
        $benum=$request->input('benum');
        $city=$request->input('city');
        $numid=$request->input('id');
        return view('cart')->with([
            'number' => $number ,
            'benum' => $benum ,
            'numid' => $numid ,
            'price' => $request->input('price') ,
            'city' => $city
            ]);
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
            'internet_service' => $data['internet_service'],
            'national_code' => $data['national_code'],
            'address' => $data['address'],
            'nationality' => $data['nationality'],
            'postal_code' => $data['postal_code'],
            'birthday' => $data['birthday'],
            'location' => $data['location'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
        
        $post = post::find($data['numid']);
        if (!is_null($post)) {
            $post->user = $data['email'];
            $post->save();
        }
        $user->save();

        $MerchantID = "XXXX-XXXX-XXXX-XXXXXXXXXXXXXXXXXXXXX";
        $Amount = $data['price'];
        $InvoiceID = $data['numid'];
        $Description = "Pay number";
        $Email = $data['email'];
        $Mobile = $data['mobile'];
        $CallbackURL = "localhost/pay";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://hamrahtog.ir/webservice/rest/PaymentRequest');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, 
        "MerchantID={$MerchantID}&Amount={$Amount}&InvoiceID={$InvoiceID}&Description={$Description}&Email={$Email}&Mobile={$Mobile}&CallbackURL=". urlencode($CallbackURL));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);$result = json_decode($curl_exec);
        if (isset($result->Status) && $result->Status == 100){
            header("Location: {$result->PaymentUrl}");
        } 
        else {
            echo (isset($result->Status) && $result->Status != "") ? $result->Status : "Error connecting to web service";
        }
        return redirect()->route('pay');    
    }

}
