<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function report(Request $request)
    {
    	$sms= new \App\SMS();
    	if($request->has('customer_id'))
    	{
    		$sms=$sms->where('customer_id',$request['customer_id']);
    	}
    	if($request->has('from'))
    	{
    		$sms=$sms->whereDate('created_at','<=',$request['from']);
    	}
    	if($request->has('to'))
    	{
    		$sms=$sms->whereDate('created_at','>=',$request['to']);
    	}

    	$smss=$sms->get();
    	return view('reports.sms',compact('smss'));
    }
}
