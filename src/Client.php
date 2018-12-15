<?php

namespace Peko\MobileMoney;

use Illuminate\Support\Facades\Validator;

class Client
{
    // Build wonderful things

     /* The amount in FCFA to be deducted from the customer. 
     * @var string
     */

	 public $amount;

	 /* The phone number of the customer. 
     * @var string
     */
	
	 public $phonenumber;

	 public function __construct($amount, $phonenumber){

	 	$this->amount = $amount;

	 	$this->phonenumber = $phonenumber;
	 }

	 public function validate_data(){

	 	$data['amount'] = $this->amount;

	 	$data['number'] = $this->phonenumber;

	 	//Make sure the number is an integer and not less than 9 digits

	 	$validator = Validator::make($data, [

	 		'number' => 'required|integer|regex:/^(\d{9})$/',

	 		'amount' => 'required|integer',
	 	]);

	 	//Checks if validator passes the test or not.

	 	if ($validator->fails()) {

		    return false;

		} else {

		    return $data;
		}
	 }

	 
}