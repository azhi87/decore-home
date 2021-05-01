<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Sale;
use \App\Installment;
use \App\Customer;
use DB;
class SaleController extends Controller
{
   public function index()
   {
     return view('sales.addSale');
   }
   public function seeSales($id=0)
   {
      if($id==0)
      {
          if(\Auth::user()->type!='admin')
        {
            $sales=Sale::where('branch_id',\Auth::user()->branch_id)->latest()->paginate(30);
        }
        else
        {
             $sales=Sale::latest()->paginate(30);
        }
            
          
      }
      else
      {
        if(\Auth::user()->type=='admin')
        {
             $sales=Sale::where('id',$id)->get();
        }
        else
        {
             $sales=Sale::where('id',$id)->where('branch_id',\Auth::user()->id)->get();
        }
       
      }
      return view('sales.seeSales',compact('sales'));
   } 

    public function seeInitials()
    {

            $sales=Sale::whereRaw('initial_amount > calculatedPaid')->latest()->paginate(30);

      return view('sales.seeSales',compact('sales'));
    }
   public function seeDeletedSales()
   {         
      $sales=\App\DeletedSale::latest()->paginate(30);
      return view('sales.seeDeletedSales',compact('sales'));
   }
   
   public function create(Request $request,$id=0)
   {

        $howManyItems=$request['howManyItems'];
        if($id==0)
        {
            $sale=new Sale();
            $sale->user_id=\Auth::user()->id;
            $sale->mandwb_id=$request['mandwb_id'];
            
        }
        else
        {
            $sale=\App\Sale::find($id);
            DB::table('installments')->where('sale_id',$id)->delete();
            DB::table('sale_items')->where('sale_id',$id)->delete();
        }
        if($request['customer_id']!=0)
        {
          $customer=\App\Customer::findOrFail($request['customer_id']);
        }
        else
        {
          $customer=new Customer;
          $customer->name=$request['name'];
          $customer->kolan=$request['kolan'];
          $customer->garak=$request['garak'];
          $customer->mal=$request['mal'];
          $customer->city=$request['city'];
          $customer->tel=$request['tel'];
          $customer->tel2=$request['tel2'];
          $customer->save();
        }

          $rate=$request['rate'];
          
        //   if($request->has('id'))
        //   {
        //       $sale->id=$request['id'];
        //   }
          
          $sale->branch_id=\Auth::user()->branch->id;
          $sale->rate=$rate;
          $sale->customer_id=$customer->id;
         
          $sale->discount=$request['discount'];
          $sale->dollars=$request['dollars'];
          $sale->dinars=$request['dinars'];
          $sale->description=$request['description'];
          
          $sale->calculatedPaid=$request['paid'];
          $sale->total=$request['total'];
          $sale->initial_amount=$request['initial_amount'];
          
        //   if($request->has('created_at'))
        //   {
        //       $sale->created_at=$request['created_at'];
        //   }
 
          $sale->installments=$request['installments'];
          if($request['status']==1)
            $sale->status='1';
          else
            $sale->status='0';

          if($request['support']==1)
            $sale->support='1';
          else
            $sale->support='0';

          $sale->completed='1';
          $sale->save();

          $from=$request['first_installment'];
          if($sale->installments>0)
          {
            $sale->completed='0';
            for ($t=0; $t<$sale->installments; $t++)
            {
                $ins=new Installment();
                $ins->created_at=$from;
                $ins->sale_id=$sale->id;
                $ins->customer_id=$sale->customer_id;
                $ins->sale_id=$sale->id;
                $ins->calculatedPaid=0;
                if($t==($sale->installments-1))
                {
                  $ins->expectedPaid=ceil(($sale->total-$sale->initial_amount)/$sale->installments);
                }
                else
                {
                  $ins->expectedPaid=floor(($sale->total-$sale->initial_amount)/$sale->installments);
                }
                $ins->user_id=\Auth::user()->id;
                $ins->created_at=$from;
                $ins->created_at=$ins->created_at->addMonths($t);
                $ins->save();
            }
                
                $sale->save();
          }

    for($i=0; $i<=$howManyItems; $i++)
    {
      if($request->has('barcode'.$i))
      {
        $barcode=$request['barcode'.$i];
        $quantity=$request['quantity'.$i];
        $item=\App\Item::find($barcode);
        $ppi=$request['ppi'.$i];
        if($ppi<$item->min)
        {
          $sale->totalBeforeDiscount-=($quantity*$ppi);
          $ppi=$item->min;
          $sale->totalBeforeDiscount+=($quantity*$ppi);
        }
        
        if($barcode===0 || $ppi===0 || $quantity===0)
        {
          continue;
        }
        
        $sale->items()->attach($barcode,['ppi'=>$ppi,'quantity'=>$quantity,'created_at'=>$sale->created_at]);
      }
    }
    
    return redirect('sale/print/'.$sale->id);
   }
   
   
   public function destroy($id)
   {
    if(\Auth::user()->type=='admin')
      {

        
        $sale=\App\Sale::find($id);
        $dsale=new \App\DeletedSale();
        $dsale->id=$sale->id;
        $dsale->dinars=$sale->dinars;
        $dsale->dollars=$sale->dollars;
        $dsale->total=$sale->total;
        $dsale->user_id=\Auth::user()->id;
        $dsale->discount=$sale->discount;
        $dsale->created_at=$sale->created_at;
        $dsale->installments=$sale->installments;
        $dsale->rate=$sale->rate;
        $dsale->mandwb_id=$sale->user_id;
        $dsale->calculatedPaid=$sale->calculatedPaid;
        $dsale->support=$sale->support;
        $dsale->branch_id=$sale->branch_id;
        $dsale->customer_id=$sale->customer_id;
        $dsale->status=$sale->status;

        foreach($sale->items as $item)
        {
          $dsale->description=$dsale->description.'---- Item_Code: '.$item->id.'';
        }
        
        $dsale->save();

        DB::table('sale_items')->where('sale_id',$id)->delete();
        DB::table('installments')->where('sale_id',$id)->delete();
        Sale::destroy($id);
        return redirect('/sale/seeSales');
      }
      else
      {

        return back()->withMessage('Error');
      }
   }
   public function salePrint($id)
   {
      $sale=Sale::find($id);
      //$invoice_headers=DB::table('invoice_headers')->find(1);
      return view('sales.salePrint',compact('sale'));
   }
   
      public function salePrintt($id)
   {
      $sale=Sale::find($id);
      //$invoice_headers=DB::table('invoice_headers')->find(1);
      return view('sales.salePrintt',compact('sale'));
   }
   
   public function accountantUpdateSale($id,Request $request)
   {
       $sale=Sale::find($id);
       $sale->description=$request['description'];
       $sale->dinars=$request['dinars']; 
       $sale->dinars_2=$request['dinars_2']; 
       $sale->dollars_2=$request['dollars_2'];
       $sale->user_id_2 = auth()->user()->id;
       $sale->calculatedPaid=( ($sale->dinars + $sale->dinars_2) /$sale->rate ) + ($sale->dollars + $sale->dollars_2);
       $sale->save();
       return redirect('/sale/print/'.$sale->id);
   }

   public function update(Request $request,$id)
   {
    $howManyItems=$request['howManyItems'];
    $rate=$request['rate'];
    $total=0;    
    $sale=Sale::findOrFail($id);
    
      if($request->has('created_at'))
          {
              $sale->created_at=$request['created_at'];
          }

    if($request['status']==1)
    {
          $sale->status='1';
    }
          else
          {
            $sale->status='0';
              
          }
    
     if($request->has('id'))
     {
         $sale->id=$request['id'];
     }

     if($request['support']==1)
     {
          $sale->support='1';
     }
          else
          {
            $sale->support='0';
     }
    $sale->calculatedPaid=$request['paid'];
    $sale->installments=$request['installments'];
    if($sale->installments<1)
    {
      $sale->calculatedPaid=$request['total'];
      $sale->completed='1';
    }
    $sale->total=$request['total'];
    $sale->description=$request['description'];
  
    $sale->save();
    $sale->items()->detach();
    
    for($i=0; $i<=$howManyItems; $i++)
    {
      if($request->has('barcode'.$i))
      {
        $barcode=$request['barcode'.$i];
        $quantity=$request['quantity'.$i];
        $item=\App\Item::find($barcode);
        $ppi=$request['ppi'.$i];
        if($ppi<$item->min)
        {
          $sale->totalBeforeDiscount-=($quantity*$ppi);
          $ppi=$item->min;
          $sale->totalBeforeDiscount+=($quantity*$ppi);
        }
        
        if($barcode===0 || $ppi===0 || $quantity===0)
        {
          continue;
        }
        
        $sale->items()->attach($barcode,['ppi'=>$ppi,'quantity'=>$quantity,'created_at'=>$sale->created_at]);
      }
    }

    
    
     return redirect('sale/print/'.$sale->id);
   }

   public function mandwbSaleReport(Request $request)
   {
      $to=$request['to'];
        $from=$request['from'];
        $sales=DB::table('sales')
                ->where('user_id',$request['user_id'])
                ->whereDate('sales.created_at','>=',$from)
                        ->whereDate('sales.created_at','<=',$to)
                ->join('sale_items','sales.id','=','sale_items.sale_id')
                ->join('items','sale_items.item_id','=','items.id')
                ->select(DB::raw('date(sales.created_at) as date'),
                     DB::raw('SUM(sales.total) as total'),
                     DB::raw('1 as n' ), //used to be count(sale_items.id)
                     DB::raw('SUM(sale_items.quantity) as quantity')
                     )

                ->groupBy(DB::raw('date'))->orderBy('date','desc')->get();
        //$sales->total=$sales->total/$sale->n;
        $user=DB::table('users')->where('id',$request['user_id'])->pluck('name');  
        $user=$user[0]; 
       return view('reports.drivers',compact(['from','to','sales','user']));
   
       return view('reports.mandwbSales',compact(['from','to','sales','user']));
   }
   
   public function QistByDateReport(Request $request)
   {
      $to=$request['to'];
      $from=$request['from'];
      $user_id=$request['user_id'];
      if($user_id!=0)
      {
        $installments=\App\Installment::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->where('user_id',$user_id)->get();
                                         $user=DB::table('users')->where('id',$request['user_id'])->pluck('name');
        
        $sales=\App\Sale::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->where('user_id',$user_id)->get();
        
        $sales_2=\App\Sale::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->where('user_id_2',$user_id)->get();
                                        
         $expenses=\App\Expense::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->where('user_id',$user_id)->get();
                                        
        $user=$user[0]; 
      }
      else
      {
        $installments=\App\Installment::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->get();  
         $sales=\App\Sale::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->get();
        $sales_2=\App\Sale::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->where('user_id_2','!=',0)
                                        ->get();
                                        
         $expenses=\App\Expense::whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->get();
                                        $user="هەموو";
      }
      
       

       return view('reports.qistByDateReport',compact(['from','to','installments','user','expenses','sales','sales_2']));
   }
   public function froshyarReport(Request $request)
   {
        $to=$request['to'];
        $from=$request['from'];
        $sales=\App\Sale::where('mandwb_id',$request['mandwb_id'])
                ->whereDate('sales.created_at','>=',$from)
                ->whereDate('sales.created_at','<=',$to)->get();

        $user=DB::table('users')->where('id',$request['mandwb_id'])->pluck('name');  
        $user=$user[0]; 
       return view('reports.mandwbSales',compact(['from','to','sales','user']));
      }

  public function support($id)
  {
    $sale=\App\Sale::findOrFail($id);
    $sale->support_no=Request('support_no');
    $sale->support='1';
    $sale->save();
    return back()->withMessage('success');
  }

   public function transfer($id)
  {
    $sale=\App\Sale::findOrFail($id);
    $sale->updated_at=\Carbon\Carbon::Now();
    $sale->status='1';
    $sale->save();

    return redirect('/sale/seeSales');
  }
 
}
