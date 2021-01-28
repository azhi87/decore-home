<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use \App\Installment;
use \App\Sale;
use \App\Customer;
use \Carbon\Carbon;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
class InstallmentController extends Controller
{
    public function index($id=0)
    {   
        if($id!=0)
        {
            $sales=\App\Sale::where('id',$id)->where('completed','0')->get();
        }
        else
        {
        	$sales=DB::select(DB::raw('select sale_id from installments where calculatedPaid=100000 group by sale_id having (datediff(curdate(),min(created_at))) > 31'));
        	$ids=array();
        	$i=0;
        	foreach ($sales as $sale)
        	{
        		$ids[$i]=$sale->sale_id;
        		$i++;
        	}
        	
        	$sales=\App\Sale::find($ids);
        	
        }
        return view('installments.installment',compact('sales'));
    }

    public function due()
    {
    	$sales=DB::select('select sale_id from installments group by sale_id having (datediff(curdate(),max(created_at))) > 90');

    }
    public function store(Request $request)
    {
    	$sale=\App\Sale::find($request['sale_id']);
    	$ins=new Installment();
    	$ins->sale_id=$request['sale_id'];
    	$ins->calculatedPaid=$request['calculatedPaid'];
    	$ins->dinarsPaid=$request['dinars']*1000;
    	$ins->dollarsPaid=$request['dollars'];
    	$ins->description=$request['description'];
        $ins->user_id=\Auth::user()->id;
        $ins->branch_id=\Auth::user()->branch->id;
        $ins->customer_id=$sale->customer_id;
    	$ins->save();
    	if($sale->ins->sum('calculatedPaid') >= $sale->total)
    	{
    		$sale->completed='1';
    		$sale->save();
    	}
        return redirect('/installments/'.$sale->id);

    }
    public function addOneInstallment($id)
    {
    	$sale=\App\Sale::find($id);
    	$ins=new Installment();
    	$ins->sale_id=$id;
    	$ins->calculatedPaid=0;
    	$ins->description="زیادکراو";
        $ins->user_id=\Auth::user()->id;
        $ins->branch_id=\Auth::user()->branch->id;
        $ins->customer_id=$sale->customer_id;
    	$ins->save();
    	
        return redirect('/installments/'.$sale->id);

    }
    
    
    public function update(Request $request)
    {
        $ins=\App\Installment::find($request['id']);
        $ins->calculatedPaid=$request['calculatedPaid'];
        $ins->expectedPaid=$request['expectedPaid'];
        $ins->description=$request['description'];
        $ins->user_id=\Auth::user()->id;
        $ins->dinarsPaid=$request['dinars']*1000;
    	$ins->dollarsPaid=$request['dollars'];

        if($request->has('created_at'))
        {
            $ins->created_at=$request['created_at'];
        }
            else
        {
            $ins->created_at=Carbon::today();     
        }

        $ins->branch_id=\Auth::user()->branch->id;

        $ins->save();
        if($ins->sale->ins->sum('calculatedPaid') >= $ins->sale->total)
        {
            $ins->sale->completed='1';
        }
        return view('installments.printInstallment',compact('ins'));
        
    }
    
    public function delete($id)
    {
        $ins=\App\Installment::findOrFail($id);
        if(\Auth::user()->type=='admin' && $ins->calculatedPaid==0)
            {
                 $sale_id=$ins->sale_id;
                $ins->destroy($id);
                $ins->save();
                \Session::flash('message','قیستەکە سڕایەوە بەسەرکەوتوویی');
                 return redirect('/installments/'.$sale_id);
            }
        else
            {
                \Session::flash('type','error');
                \Session::flash('message','ناتانیت');
                return redirect('/');

            }
       
    	
    }



	public function searchByTel(Request $request)
	{
       
		if($request->has('tel'))
		{
			$customer_id=\App\Customer::where('tel',$request['tel'])
                                      ->orWhere('tel2',$request['tel'])
                                      ->latest()->pluck('id');
            if(count($customer_id))
            {
                if(\Auth::user()->type!='admin')
                {
                    $sales=\App\Sale::where('completed','0')->where('branch_id',\Auth::user()->branch_id)->where('customer_id',$customer_id)->get();
                }
                else
                {
                     $sales=\App\Sale::where('completed','0')->where('customer_id',$customer_id)->get();
                }
                if(count($sales))
                {
                    return view('installments.installment',compact('sales'));
                }
                else
                {
                    \Session::flash('message','هیچ قیستێکی لا نەماوە');
                    \Session::flash('type','error');
                    return redirect('/installments');
                }
            }
            else
            {
                \Session::flash('message','ژمارەی مۆبایلەکە هەڵەیە');
                \Session::flash('type','error');
                return redirect('/installments');
            }
        }
			
		else
		{
			\Session::flash('message','تکایە ژمارەی مۆبایلی کڕیار داخڵبکە');
            \Session::flash('type','error');
			return redirect('/installments');
		}
		
	}

	public function searchBySid(Request $request)
	{
		if($request->has('sid'))
		{
			$sales=\App\Sale::where('id',$request['sid'])->where('installments','>',0)->get();
			return view('installments.installment',compact('sales'));
		}
		else
		{
			\Session::flash('message','تکایە ژمارەی مۆبایلی کڕیار داخڵبکە');
            \Session::flash('type','error');
			return redirect('/installments');
		}
		
	}

    public function edit($id)
    {
        $ins=Installment::findOrFail($id);
        return view('installments.installmentUpdate',compact('ins'));
    }

    public function prnt($id)
    {
        $ins=Installment::find($id);
        return view('installments.printInstallment',compact('ins'));

    }
    public function report()
    {

        $ins=\App\Installment::select(DB::raw('max(id) as id'))->groupBy(['sale_id'])->latest()->get()->toArray();
        
        $ids=array();
        $i=0;
        foreach ($ins as $in)
        {
            $ids[$i]=$in['id'];
            $i++;
        }   
        $ins=\App\Installment::find($ids);

        return view('reports.installmentReport',compact('ins'));
    }
    public function dueInstallments()
    {
        $ins=\App\Installment::where('calculatedPaid',0)
        ->whereDate('created_at','<',Carbon::today())
        ->pluck('sale_id')
        ->toArray();
        $in=array_unique($ins);
        if(\Auth::user()->type!='admin')
            {
                $ins=\App\Sale::whereIn('id',$in)->where('branch_id',\Auth::user()->branch_id)->get();
            }
            else
            {
                $ins=\App\Sale::whereIn('id',$in)->get();
            }
        return view('reports.dueInstallments',compact('ins'));
    }
    
     public function dueInstallmentsByDate(Request $request)
    {
        $from=$request['from'];
        $to=$request['to'];
        $ins=\App\Installment::where('calculatedPaid',0)
                            ->whereDate('created_at','>=',$from)
                            ->whereDate('created_at','<=',$to)
                            ->orderBy('sale_id')
                            ->paginate(500);
        return view('reports.dueInstallmentByDate',compact('ins'));
    }


      public function send($id)
    {
        $ins=\App\Installment::findOrFail($id);
        $customer=$ins->sale->customer;
        $message_header1='لە مۆبیلیاتی دیکۆر هۆمەوە: ';
        $message_header='بەڕێز '. $customer->name;
        $message_body="قیستەکانتان دواکەوتووە تکایە سەردانمان بکەن";
        $tel=preg_replace("/^0/", "964", $customer->tel);

        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);
        try
        {
            $client->messages->create(
                '+'.$tel,
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => 'Decor-Home',
                 // the body of the text message you'd like to send
                 'body' =>  $message_header1.' : '.$message_header.' :'.$message_body
             )
         );
            \Session::flash('message', 'نامەکە بەسەرکەوتوویی نێررا');
                    $sms=new \App\SMS();
                    $sms->user_id=\Auth::user()->id;
                    $sms->customer_id=$customer->id;
                    $sms->installment_id=$ins->id;
                    $sms->message=$message_header.'<br/>'.$message_body;
                    $sms->save();
   }

        catch (Exception $e)
        {
            \Session::flash('message', $e->getMessage());
        }
                return redirect('/reports/due');
    }
       
}

