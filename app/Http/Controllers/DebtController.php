<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use \App\Customer;
use \App\Debt;
use Illuminate\Http\Request;
use Redirect;
use DB;
class DebtController extends Controller
{
	public function index($id=0)
	{
		if($id==0)
		{
		return view('customers.debts');
		}
		else
		{
			$customer=Customer::find($id);
			return view('customers.debts',compact('customer'));
		}
	}
	public function search(Request $request)
	{

		if($request->has('tel'))
		{
			$customer=Customer::where('tel',$request['tel'])->first();

		}
		elseif($request->has('name'))
		{
			$customer=Customer::where('name','LIKE','%'.$request['name'].'%')->first();
		}
		else
		{
			\Session::flash('message','تکایە ژمارەی یان ناوی کڕیار داخڵبکە');
			return redirect('/debts');
		}
		if(!count($customer))
		{
			\Session::flash('message','ژمارەی تەلەفۆن یان ناوەکە هەڵەیە ');
			return redirect('/debts');
		}
		
		else
		{
			return redirect('/debts/'.$customer->id);
		}
	}
	public function store(Request $request,$id=0)
	{
		//dd($request);
		$this->validate($request,[
    		"customer_id"=>"required",
    		"dinars"=>"required",
            "dollars"=>"required",
            "calculatedPaid"=>"required",
    		]);
		if($id==0)
		{
			$debt=new Debt();
			$debt->customer_id=$request['customer_id'];
		    $customer=\App\Customer::find($debt->customer_id);
		    if($customer->hasUnConfirmedDebts())
			{
			    \Session::flash('message', 'ناتوانی لە ئێستادا قەرزدانەوە تۆمار بکەیت');
			    return back();
			}
			
			$debt->user_id=\Auth::user()->id;
			$debt->rate=$request['rate'];
			
		}
		else
		{
			$debt=Debt::find($id);
			if($debt->status=='0' && $request['status']=='1')
    		{
    		    $debt->created_at = Carbon::now();
    		}
			$debt->status=$request['status'];
		}
		
		$debt->dinars=$request['dinars'];
		$debt->dollars=$request['dollars'];
		$debt->description=$request['description'];
		$debt->calculatedPaid=$request['dollars']+($request['dinars']/$request['rate']);
		$debt->save();
		//$customer=Customer::find($request['customer_id']);
		// return view('customers.debts',compact('customer'));
		return redirect('/debts/'.$request['customer_id']);
	}

	public function income(Request $request)
    {
    	$branch_id=$request['branch_id'];
    	$sale=new \App\Sale();
        	$from=$request['from'];
        	$to=$request['to'];
        	if($branch_id==0)
        	{
        		$sale=$sale->whereDate('created_at','>=',$request['from'])
        			   ->whereDate('created_at','<=',$request['to'])
        			   ->sum('calculatedPaid');

        		$qist=new \App\Installment();
        				$qist=$qist->whereDate('created_at','>=',$request['from'])
        			   ->whereDate('created_at','<=',$request['to'])
        			   ->sum('calculatedPaid');

        	}
        	else
        	{

        		$sale=$sale->whereDate('created_at','>=',$request['from'])
        			   ->whereDate('created_at','<=',$request['to'])
        			   ->where('branch_id',$branch_id)
        			   ->sum('calculatedPaid');

       			 $qist=new \App\Installment();
        		$qist=$qist->whereDate('created_at','>=',$request['from'])
        			   ->whereDate(
        			       'created_at','<=',$request['to'])
        			   ->where('branch_id',$branch_id)
        			   ->sum('calculatedPaid');


        	}    

        return view('reports.income',compact(['sale','qist','from','to']));
        	
    }

    public function thresholdReport(Request $request)
    {

    	
        $debts=\App\Customer::all();
       
       

       	$debts= DB::select( DB::raw("
       		select id,name,
			(
			    SELECT IFNULL(sum(total),0) FROM sales where sales.customer_id=customers.id and sales.status='1' 
			)
			-
			(
			   SELECT  IFNULL(SUM(calculatedPaid),0) from debts where customers.id=debts.customer_id and debts.status='1'
			)

			    AS totalDebt from customers 
			    GROUP BY customers.id
			    HAVING totalDebt>=".$request['threshold']
       		));
       
    	
		return view('reports.debtThreshold',compact('debts'));        
    }
    public function debtPrint($id)
    {
        $debt=\App\Debt::find($id);
        return view('customers.debtPrint',compact('debt'));
    }
   
}
