<?php




	Route::group(['namespace' => 'Peko\MobileMoney\Http\Controllers', 'middleware' => ['web']], function(){

	    Route::post('mtnpay', 'MTNPaymentController@momo')->name('mtn');

	    Route::post('monetbilpay', 'MonetbilPaymentController@monetbil')->name('monetbil');

	});