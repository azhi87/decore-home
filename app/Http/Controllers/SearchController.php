<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
class SearchController extends Controller
{

    public function allProfit(Request $request)
    {
        $from=$request['from'];
        $to=$request['to'];
        $branch_id=$request['branch_id'];
        $profits=array();
        $profits['expense']=($this->totalExpenseByDate($from,$to,$branch_id));
        $profits['purchase']=($this->totalPurchaseByDate($from,$to));
        $profits['itemProfit']=($this->totalItemProfit($from,$to,$branch_id));
        $profits['sale']=($this->totalSaleByDate($from,$to,$branch_id));

        $profits['qist']=($this->totalQistByDate($from,$to,$branch_id));

        //$profits['debt']=($this->totalDebtByDate($from,$to));
        $profits['totalProfit']=$profits['itemProfit']-($profits['expense']);
        return view('reports.allProfit',compact(['profits','from','to']));

    }
    public function searchSale(Request $request)
    {

    	$conditions=array();
    
    	if ($request['user_id']!=-1) 
    	{
    		$conditions['user_id']=$request['user_id'];
    	}

        if ($request['qist']!=-1) 
        {
            if($request['qist']==1)
            $conditions['completed']='1';
            else
            $conditions['completed']='0';    
        }
        	if ($request->filled('sale_id')) 
    	{
    		$conditions['id']=$request['sale_id'];
    	}
    	
    		$sales=\App\Sale::where($conditions)->latest();
    	if ($request->filled('tel')) 
    	{
    	
    			$customer=\App\Customer::where('tel',$request['tel'])
                                      ->orWhere('tel2',$request['tel'])
                                      ->pluck('id');
    		            $sales->whereIn('customer_id',$customer);


    	}

    	elseif ($request->filled('customer_name')) 
    	{
    		$customer=\App\Customer::where('name','like','%'.$request['customer_name'].'%')->pluck('id');
    		            $sales->whereIn('customer_id',$customer);


    	}
    	
    	
        
    
    	if ($request->filled('from')) 
    	{
    		$sales->whereDate('created_at','>=',$request['from']);
    		
    	}
    	if ($request->filled('to')) 
    	{
    		$sales->whereDate('created_at','<=',$request['to']);
    	}
    	$sales=$sales->paginate(100);
    	$sales->setPath('/sale/seeSales');
   		
    	return view('sales.seeSales',compact('sales'));
    }
    public function searchDebt(Request $request)
    {
        $conditions=array();
        //$sales=\App\Sale::whereNotNull('created_at');
        if ($request->filled('debt_id')) 
        {
            $conditions['id']=$request['debt_id'];
        }


        if ($request->filled('customer_id')) 
        {
            $conditions['customer_id']=$request['customer_id'];
        }
        elseif ($request->filled('customer_name')) 
        {
            $customer=\App\Customer::where('name','like','%'.$request['customer_name'].'%')->first()->id;
            $conditions['customer_id']=$customer;

        }
        elseif ($request->filled('tel')) 
        {
            $customer=\App\Customer::where('tel','like','%'.$request['tel'].'%')->first()->id;
            $conditions['customer_id']=$customer;

        }
       
        if ($request['user_id']!=-1) 
        {
            $conditions['user_id']=$request['user_id'];
        }
        if ($request['status']!=-1) 
        {
            $conditions['status']=$request['status'];

        }
        $debts=\App\Debt::where($conditions)->latest();
        if ($request->filled('from')) 
        {
            $debts->whereDate('created_at','>=',$request['from']);
            
        }
        if ($request->filled('to')) 
        {
            $debts->whereDate('created_at','<=',$request['to']);
        }
        $debts=$debts->paginate(100);
        $debts->setPath('/customer/seeDebts');
        
        return view('customers.seeDebts',compact('debts'));
    }
    
    public function totalQistByDate($from,$to,$branch_id)
    {
        if($branch_id==0)
        {
            return DB::table('installments')->where('created_at','>=',$from)
                          ->where('created_at','<=',$to)
                                        ->sum('calculatedPaid');
        }
        else
        {
        return DB::table('installments')->where('created_at','>=',$from)
                          ->where('created_at','<=',$to)
                          ->where('branch_id',$branch_id)
                                        ->sum('calculatedPaid');
        }
    }
    public function totalSaleByDate($from,$to,$branch_id)
    {
        if($branch_id==0)
        {
            return DB::table('sales')->where('created_at','>=',$from)
                          ->where('created_at','<=',$to)
                                        ->sum('total');
        }
        else
        {
        return DB::table('sales')->where('created_at','>=',$from)
                          ->where('created_at','<=',$to)
                            ->where('branch_id',$branch_id)
                                        ->sum('total');
        }
    }

    

    
    
    public function totalPurchaseByDate($from,$to)
    {
        return DB::table('purchases')->where('created_at','>=',$from)
                          ->where('created_at','<=',$to)
                                        ->sum(DB::raw('total+(discount+extra)'));
    }

    public function totalExpenseByDate($from,$to,$branch_id)
    {
        if($branch_id==0)
        {
        return DB::table('expenses')->whereDate('created_at','>=',$from)
                          ->whereDate('created_at','<=',$to)->sum('amount');
        }
        else
        {
           return DB::table('expenses')->whereDate('created_at','>=',$from)
                          ->whereDate('created_at','<=',$to)
                          ->where('branch_id',$branch_id)
                          ->sum('amount'); 
        }
    }


    public function totalItemProfit($from,$to,$branch_id)
    {
        $items=\App\Item::all();
        $result=0;
        
        foreach($items as $item)
        {
            if($branch_id==0)
            {
                $result+=$item->totalProfit($from,$to);
            }
            else
            {
                $result+=$item->totalProfitByBranch($from,$to,$branch_id);
            }
        }
        
        return $result;
    }

    
    public function totalDebtByDate($from,$to)
    {
        return DB::table('debts')->whereDate('created_at','>=',$from)
                          ->whereDate('created_at','<=',$to)->sum('calculatedPaid');
    }
    public function stpReport(Request $request)
    {
        $from=$request['from'];
        $to=$request['to'];
        
        $sales=\App\Sale::whereDate('created_at','>=',$from)->whereDate('created_at','>=','$from')
        ->whereHas('items', function($q) {
                                            $q->groupBy(['item_id',DB::RAW('date(sale_items.created_at)')]);
            
        })
        ->get();


        return view('/reports/stpReport',compact(['sales','from','to']));
    }
    
    public function stpSalePurchase(Request $request)
    {
        $id=$request['item_id'];
        $item=\App\Item::findOrFail($id);
        $from=$request['from'];
        $to=$request['to'];
       if(isset($request['sale']))
       {
          $sales=\App\Sale::whereDate('sales.created_at','>=',$from)
                        ->whereDate('sales.created_at','<=',$to)
                        // ->join('sale_items','sales.id','=','sale_items.sale_id')
                        // ->where('sale_items.item_id','like',$id)
                        ->get();
           return view('reports.stpSale',compact(['sales','from','to','item']));
       }
       else
       {
           $purchases=\App\Purchase::whereDate('purchases.created_at','>=',$from)
                        ->whereDate('purchases.created_at','<=',$to)
                        // ->join('purchase_items','purchases.id','=','purchase_items.purchase_id')
                        // ->where('purchase_items.item_id','like',$id)
                        ->get();
           return view('reports.stpPurchase',compact(['purchases','from','to','item']));
       }
    
    }
}
