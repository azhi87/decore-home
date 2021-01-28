<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Garak;
class CustomerController extends Controller
{
    public function index($id=0)
    {
        if($id!=0)
        {
            $customers=Customer::where('id',$id)->paginate(15);
        }
        else
        {    
            $customers=Customer::latest()->paginate(15);
        }
    	return view ('customers.customerHome',compact('customers'));
    }
    public function store(Request $request,$id=0)
    {
    
    	if($id!=0)
    	{
    		$customer=Customer::find($id);
    	    $resultMessage='گۆڕانکاریەکە بەسەرکەوتوویی تۆمارکرا';
    	}
    	else
    	{
    	     $this->validate($request,[
            "name"=>"required|min:1",
            "tel"=>"required|min:11",
            "id"=>"unique:customers",
            ]); 
    		$customer=new Customer;
    		$resultMessage='فرۆشیارەکە بەسەرکەوتوویی زیاد کرا';

    	}
    	if(\Auth::user()->type!='mandwb')
    	{
        	if($request->has('id'))
        	{
        		$customer->id=$request['id'];
        	}
            
        	$customer->name=$request['name'];
        	$customer->city=$request['city'];
        	$customer->garak=$request['garak'];
            $customer->kolan=$request['kolan'];
            $customer->mal=$request['mal'];

        }
            $customer->tel=$request['tel'];
            $customer->tel2=$request['tel2'];
    	if($customer->save())
    		{	
    			\Session::flash('message',$resultMessage);
                return redirect('/customers');
    		}
        else
        	{
        		return view('errors.404');
        	}
    }
   
    public function search(Request $request)
    {
        if($request->has('tel'))
        {
            $customers=Customer::where('tel',$request['tel'])->paginate(100);
        }
        elseif($request->has('name'))
        {
            $customers=Customer::where('name','LIKE','%'.$request['name'].'%')->paginate(55);
        }
        else
        {
            return redirect('/customers');
        }
        return view('customers.customerHome',compact('customers'));
    }
    

    public function getDetails()
    {
        $customer=\App\Customer::find(Request('id'));
        if($customer)
        {
            
            return json_encode(array(
                "customerName" => $customer->name,
                "tel" => $customer->tel,
                "tel2" =>$customer->tel2,
                "city" =>$customer->city,
                "garak" =>$customer->garak,
                "kolan" =>$customer->kolan,
                "mal" =>$customer->mal
                )); 
        }
    }
        

    public function signaturePrint(Request $request)
    {
        if($request->has('garak'))
        {
            $garak=Garak::where('garak','like','%'.$request['garak'].'%')->first();
            if(!count($garak))
            {
                $text="هیچ گەڕەکێک بەو ناوەوە نییە";
                \Session::flash('message', $text);
                return redirect('/customers');
            }
            $customers=$garak->customers;
            if(!count($customers))
            {
                $text="هیچ کڕیارێک لەو گەڕەکە نیە";
                \Session::flash('message', $text);
                return redirect('/customers');
            }
            $garak=Garak::where('garak','like','%'.$request['garak'].'%')->get()->first();
            $garak=$garak->garak;
           
        }
        else
        {
            $text="تکایە گەڕەک هەڵبژێرە";
            \Session::flash('message', $text);
            return back();
        }
        if($request->exists('marketReportSubmit'))
        {
            return view('customers.signatureReport',compact(['customers','garak']));
        } 
        elseif($request->exists('dailyReportSubmit'))
        {
            return view('customers.dailyReport',compact(['customers','garak']));
        }   
        elseif($request->has('debtSubmit'))
        {

        }

    }
    public function kashfi7sab($id)
    {
        $customer=Customer::findOrFail($id); 
        return view('customers.kashfi7sab',compact('customer'));
    }

    
}
