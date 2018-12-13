<?php

namespace Peko\MobileMoney\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Config;

use Redirect;

class MTNPaymentController extends Controller
{
    //

    public function momo(Request $request){

    	//dd((int)$request->number);
    	//dd((int)$request->amount);

    	//$this->validate($request,['number'=>'required|integer']);

    	$data = Config::get('mobilepayment.mtnpay.email');

    	dd($data);

    }

    
}