<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XwastnController extends Controller
{
    public function index()
    {
        if(\Auth::user()->type!='admin')
        {
            $xwastns=\App\Xwastn::where('branch_id',\Auth::user()->branch_id)->latest()->get();
        }
        else
        {
            $xwastns=\App\Xwastn::latest()->get();

        }
    	return view('xwastns.seeXwastns',compact('xwastns'));
    }
    public function store(Request $request)
    {
    	$customer=\App\Customer::where('tel',request('tel'))->first();
        if(!count($customer))
        {
           $this->validate($request,[
            "name"=>"required|min:2",
            "tel"=>"required|min:11|Unique:customers",
            "address"=>"required"
            ]); 

          $customer=new \App\Customer();
          $customer->name=$request['name'];
          $customer->name=$request['name'];
          $customer->address=$request['address'];
          $customer->tel=$request['tel'];
          $customer->tel2=$request['tel2'];
          $customer->save();
        }
    	$xwastn=new \App\Xwastn();
    	$xwastn->quantity=$request['quantity'];
    	$xwastn->item_name=$request['item_name'];
    	$xwastn->quantity=$request['quantity'];
    	$xwastn->description=$request['description'];
    	$xwastn->customer_id=$customer->id;
        $xwastn->user_id=\Auth::user()->id;
    	$xwastn->branch_id=\Auth::user()->branch_id;
    	$xwastn->save();
    	return redirect('/xwastns');
    }
    public function add()
    {
    	return view('xwastns.addXwastn');
    }
    public function delete($id)
    {
    	\App\Xwastn::destroy($id);
    	 \Session::flash('message', 'خواستنەکە بەسەرکەووتویی سڕایەوە');
      return redirect('/xwastns');
    }
}
