<?php
/*
	PAYMOB Library 

	Functions 
	-------------
	1. get_api_token()
	2. order_registration()
	3. payment_key_request()
	4. curl_request()
*/

class Kiosk{
    
	private $curl;
    private $api_key = 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnVZVzFsSWpvaWFXNXBkR2xoYkNJc0luQnliMlpwYkdWZmNHc2lPalUwTlRNM05Dd2lZMnhoYzNNaU9pSk5aWEpqYUdGdWRDSjkuNktYQmhhM2FzN251TzNzci1pU2kxdlg3bG5Id2hYQldZbDYyLXF1bi1jQ0dRQk1Ma1BvV0dOSkl3ejdfa19QQy1GQ1BKdzdxUmNVY1BpRjRaUjJjX0E=';
    private $paymob_id = '3057630'; //2992646 //2912687
    
    function __construct()
    {
        $this->CI =& get_instance();
    }
    
    public function get_api_token()
    {
        $end_point = 'https://accept.paymob.com/api/auth/tokens';
        $method = "POST";
        $data= '{
            "api_key": "' . $this->api_key . '"
        }';
        $token = $this->curl_request($end_point, $method, $data);
        return json_decode($token);
    }

    public function order_registration($token, $amount, $items, $data)
    {
        //"merchant_order_id": "5j56465d",
        //,
        // "shipping_data":' . $data . ',
        //   "shipping_details": {
        //       "notes" : " NA",
        //       "number_of_packages": "NA",
        //       "weight" : "NA",
        //       "weight_unit" : "NA",
        //       "length" : "NA",
        //       "width" :"NA",
        //       "height" :"NA",
        //       "contents" : "NA"
        //   }
        $end_point = 'https://accept.paymob.com/api/ecommerce/orders';
        $method = "POST";
        $data= '{
            "auth_token":"' . $token . '",
            "delivery_needed": "false",
            "amount_cents": "' . $amount .'",
            "currency": "EGP",
            "items":' . $items . '
          }';
          
        $res = $this->curl_request($end_point, $method, $data);
        return json_decode($res);
    }

    public function payment_key_request($token, $amount, $order_id, $data)
    {
        $end_point = 'https://accept.paymob.com/api/acceptance/payment_keys';
        $method = "POST";
        $data= '{
            "auth_token":"' . $token . '",
            "amount_cents": "' . $amount .'",
            "expiration": 3600, 
            "order_id":' . $order_id . ',
            "billing_data":' . $data . ', 
            "currency": "EGP", 
            "integration_id":' . $this->paymob_id . ',
            "lock_order_when_paid": "false"
          }';
        $payment_token = $this->curl_request($end_point, $method, $data);
        return json_decode($payment_token);
    }
    
    public function kiosk_payment($token)
    {
        $end_point = 'https://accept.paymob.com/api/acceptance/payments/pay';
        $method = "POST";
        $data= '{
                  "source": {
                    "identifier": "AGGREGATOR", 
                    "subtype": "AGGREGATOR"
                  },
                  "payment_token":"' . $token . '"
                }';
        $res = $this->curl_request($end_point, $method, $data);
        return json_decode($res);
    }

	
	public function curl_request($end_point,$method,$data){
		$this->curl = curl_init();

		curl_setopt_array($this->curl, array(
			CURLOPT_URL => $end_point,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => strtoupper($method),
			CURLOPT_POSTFIELDS => $data,   /* array('test_key' => 'test_value_1') */
			CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
			),
		));
		
		$response = curl_exec($this->curl);
		
		curl_close($this->curl);
		return $response;
	}

}
?>