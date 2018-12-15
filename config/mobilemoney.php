<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Mobile Payment Configuration
	|--------------------------------------------------------------------------
	|
	|
	|
	|  SET UP YOUR PAYMENT CREDENTIALS FROM THE .env FILE
	|
	|  For MTN Cameroon Mobile payments, copy the following, paste in your .env file and provide the details.
	|
	|   * MTN_EMAIL = your mtn developer's email
	|   * MTN_PASSWORD = your mtn developer's password
	|
	|   
	|  For Monetbil Payment Gateway, copy the following, paste in your .env file and provide the details.
	|   
	|   * MONETBIL_SERVICE = your monetbil service code
	|   
	|
	| 
	|
	*/

	

	'mtn' => [
        'email' => env('MTN_EMAIL'),
        'password' => env('MTN_PASSWORD'),
        'phonenumber'=>env('MTN_NUMBER'),
        
    ],

    'monetbil' => [
        'service' => env('MONETBIL_SERVICE'),        
    ],

	
];