<?php
namespace App\PaymentProviders\PSP;

class Payment
{
    protected $apiKey;
    public $paymentUrl;
    public $errorCode;
    public $errorMessage;

    /**
     * Payment constructor.
     */
    public function __construct()
    {
        $this->apiKey = site_config('payment_api_key') ? site_config('payment_api_key') : 'test';
    }

    /**
     * @param $amount
     * @param null $mobile
     * @param null $factorNumber
     * @param null $description
     * @return mixed
     */
    public function send($amount, $factorNumber, $mobile = null, $description = null)
    {
		$Description 	= "Payment ID {$factorNumber}";
		$Email 			= "";
		$Mobile 		= "";
		$CallbackURL 	= route('callback');

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://hamrahtog.ir/webservice/rest/PaymentRequest');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type' => 'application/json'));
		curl_setopt($curl, CURLOPT_POSTFIELDS, "MerchantID={sandbox}&Amount={$amount}&InvoiceID={$factorNumber}&Description={$Description}&Email={$Email}&Mobile={$Mobile}&CallbackURL=". urlencode($CallbackURL));
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_exec = curl_exec($curl);
		curl_close($curl);

		$result = json_decode($curl_exec, true);

		if (isset($result['Status']) && $result['Status'] == 100)
		{
			$result['Status'] 	= 1;
			$result['status'] 	= 1;
			$result['token'] 	= $result['Authority'];
			$this->paymentUrl 	= $result['PaymentUrl'];
		} else {
			if (isset($result['Status'])) {
				$this->errorCode = $result['Status'];
			}

			if (isset($result['Status'])) {
				$this->errorMessage = $result['Status'];
			}
		}

        return $result;
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
