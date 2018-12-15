<?php

namespace Peko\MobileMoney\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Config;

use Peko\MobileMoney\Librairies\MTNMobileMoney;

use Redirect;

class MTNPaymentController extends Controller
{
    //

    public function momo(Request $request){

    	

    	$mobile = new MTNMobileMoney($request->amount, $request->number);

    	$message = $mobile->validate_data();

    	if ($message != 'Wrong number'){

		    	if ($message === false){

		    		return response()->json('The telephone number is incorrect');

		    	} else{

		    		$dtails = $mobile->run_payment($message['number'], $message['amount']);
		    	}
    	}

    	return response()->json('Target number is same as business number');
    }

    
}