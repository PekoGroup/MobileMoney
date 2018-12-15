<?php

namespace Peko\MobileMoney\Librairies;

use Peko\MobileMoney\Client;

use GuzzleHttp\Psr7;

use Config;

class MTNMobileMoney extends Client{

	const idbouton = 2;
	
	const typebouton = 'PAIE';

	const MTN_URL = 'https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml';

	/**
     * This is the X coordinate submitted from the customer's clicking.
     *
     * @var string
     */

		public $submitX;


	/**
     * This is the Y coordinate submitted from the customer's clicking.
     *
     * @var string
     */


		public $submitY; 


	public function mtn_tokens($number, $amount){

		$token['momo_pwd'] = Config::get('mobilemoney.mtn.password');

		$token['momo_email'] = Config::get('mobilemoney.mtn.email');

		$token['number'] = $number;

		$token['amount'] = $amount;

		$token['submit.x'] = 104;

		$token['submit.y'] = 70;

		return $token;


	}

	public function prepare_guzzle($data){

		$data = ['idbouton'=>self::idbouton,'typebouton'=>self::typebouton,'_amount'=>$data['amount'],
                  '_tel'=>$data['number'],'_clP'=>$data['momo_pwd'],'_email'=>$data['momo_email'],
                  'submit.x'=>$data['submit.x'],'submit.y'=>$data['submit.y']];

        $redirects  = ['max'=> 5,'strict'=> true];

        return ['path'=>self::MTN_URL, 
	            'https_data'=>['query'=>$data, 'allow_redirects'=>$redirects]
	           ];

	}

	private function initialize_guzzle($path, $https){

		//$this->addToRequestSession_momo($https['query']); //ADDS TO PRE-SALES TABLE

		try{

          	return $this->run_guzzle($path, $https); 	
          }

		catch (RequestException $exception) {

		  	return $e;

	      }
	}


	private function run_guzzle($path, $https){

		$client = new \GuzzleHttp\Client();

		$result = $client->get($path, $https); 

         if($result->getStatusCode()===200){ 
             
             $momodata = json_decode($result->getBody()->getContents());
             
             return $momodata;
           
          }
         return response()->json(['confirmed'=>false,'paymentdata'=>null]);
	}


	public function run_payment($number, $amount){

		$details = $this->mtn_tokens($number, $amount);

		$data = $this->prepare_guzzle($details);

		$results = $this->initialize_guzzle($data['path'], $data['https_data']);

		return $results;
	}
}

