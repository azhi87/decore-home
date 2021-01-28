<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransferController extends Controller
{
	public function index()
	{
		$transfers=\App\Transfer::latest()->paginate(20);
		return view('transfers.transfer',compact('transfers'));
	} 
	public function store(Request $request,$id=0)
	{
		if($id==0)
		{
			$transfer=new \App\Transfer();
			$result='پارەدانەوەکە بە سەرکەوتوویی تۆمارکرا';
		}
		else
		{
			$transfer=\App\Transfer::find($id);
			$result='گۆڕانکاریەکە بە سەرکەوتوویی تۆمارکرا';
		}
		$transfer->user_id=\Auth::user()->id;
		$transfer->amount=$request['amount'];
        if($request->has('created_at'))
	    {
	        $transfer->created_at=$request['created_at'];
	    }
		$transfer->type=$request['currency'];
		$transfer->supplier_id=$request['supplier_id'];
		$transfer->description=$request['description'];
		$transfer->save();
		\Session::flash('message',$result);
		return redirect('/transfers');
	}
	public function edit($id)
	{
	
		$transfer=\App\Transfer::find($id);
	
		return view('transfers.updateTransfer',compact('transfer'));
	}
	public function searchByDate(Request $request)
	{
	    $from=$request['from'];
	    $to=$request['to'];
	    $transfers=\App\Transfer::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->paginate(200);
	    return view('transfers.transfer',compact('transfers'));
	}
	public function searchBySupplier(Request $request)
	{
	    $supplier_id=$request['supplier_id'];
	    $transfers=\App\Transfer::where('supplier_id',$supplier_id)->paginate(200);
	    return view('transfers.transfer',compact('transfers'));
	}
}
