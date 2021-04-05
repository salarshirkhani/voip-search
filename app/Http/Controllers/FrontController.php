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
use App\PaymentProviders\PSP\Payment;

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
    public function callbackPayment(Request $request)
    {
        $rules = [
            'id' => 'required|exists:transactions,id',
            'token' => 'required',
            'status' => 'required|numeric|in:0,1',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            abort(404);
        }

        try {
            DB::beginTransaction();
            $transaction = Transaction::lockForUpdate()->find($request->id);
            if ($transaction)
			{
                if ($transaction->status && $transaction->verified)
				{
                    return $this->showReceipt($transaction);
                } else if (!$transaction->status && !$transaction->verified && isset($transaction->payment_info['token']) && $transaction->payment_info['token'] == $request->token) {
					$paymentProvider = new Payment();
					$verify = $paymentProvider->verify($request->token, $transaction->amount);
					if ($verify && isset($verify->Status) && isset($verify->Amount) && isset($verify->InvoiceID))
					{
                        if ($verify->Status == 100 && $verify->Amount == $transaction->amount)
						{
                            $transaction->update([
                                'payment_info' => [
                                    'token' 		=> $request->token,
                                    'trans_id' 		=> $verify->InvoiceID,
                                    'card_number' 	=> $verify->MaskCardNumber,
                                    'status' 		=> $verify->Status,
                                ],

                                'status' 		=> 1,
                                'verified' 		=> 1,
                                'paid_at' 		=> date('Y-m-d H:i:s'),
                                'verified_at' 	=> date('Y-m-d H:i:s'),
                            ]);
                            switch ($transaction->type)
							{
                                case Transaction::$type['form']:
                                    $transaction->form()->update(['pay_count' => $transaction->form()->pay_count + 1]);
                                    break;
                                case Transaction::$type['factor']:
                                    $transaction->factor()->update([
                                        'paid' => 1,
                                        'transaction_id' => $transaction->id,
                                    ]);
                                    break;
                            }
                            \DB::commit();

                            return $this->showReceipt($transaction);
                        }
                    }
                }
            }
            DB::rollBack();

            return $this->showReceipt($transaction);
        } catch (\Exception $e) {
            if (env('APP_ENV') === 'local') {
                throw $e;
            } else {
                abort(500);
            }
        }
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

        $MerchantID = "sandbox";
        $Amount = $data['price'];
        $InvoiceID = $data['numid'];
        $Description = "Pay number";
        $Email = $data['email'];
        $Mobile = $data['mobile'];
        $CallbackURL = "localhost/pay";
        $paymentProvider = new Payment();
        $paymentInfo = $paymentProvider->send($data['price'], $data['numid']);
        if (isset($paymentProvider->paymentUrl) && $paymentProvider->paymentUrl) {
            $transaction->update([
                'payment_info' => [
                    'token' => $paymentInfo['token'],
                ],
            ]);

            return redirect($paymentProvider->paymentUrl);
        }

        return redirect()->back()
            ->with('alert', 'danger')
            ->with('message', isset($paymentProvider->errorMessage) ? $paymentProvider->errorMessage : 'Error');
   
    }

    /**
     * @param $token
     * @return mixed
     */
    public function verify($Authority, $Amount)
    {
		$Amount 	= (isset($Amount) && $Amount != "") 		? $Amount 		: 0;
		$Authority 	= (isset($Authority) && $Authority != "") 	? $Authority 	: "";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://hamrahtog.ir/webservice/rest/PaymentVerification');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
		curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={$this->apiKey}&Amount={$Amount}&Authority={$Authority}");
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_exec = curl_exec($curl);
		curl_close($curl); 

		$result = json_decode($curl_exec);

		return $result;
    }

}
