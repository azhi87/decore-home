<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use DB;
use Carbon\Carbon;
class ExpenseController extends Controller
{
	public $user;
	public function __construct()
	{
		if(\Auth::check())
		{
			$this->user=\Auth::user();
		}
    }
  
    public function index()
    {
    		$expenses=Expense::where('branch_id',\Auth::user()->branch_id)->latest()->paginate(25);
    	return view('expenses.expenseHome',compact('expenses'));
    }

    public function store($id=0)
    {
    	$this->validate(request(),[
    		"amount"=>"required",
    		]);
        if($id==0)
        {
            $expense=new Expense();
            $expense->user_id=\Auth::user()->id;
            $message='مەصروفاتەکە بەسەرکەوتوویی زیادکرا';
        }
    	else
        {
            $expense=Expense::findOrFail($id);
            $message='گۆڕانکاریەکە بەسەرکەوتوویی تۆمارکرا';
        }

        if(!is_null(request('reason_new')))
        {
            DB::table('reasons')->insert(['name'=>request('reason_new')]);
            $expense->reason=request('reason_new');
        }
        else
        {
            $expense->reason=request('reason');
        }
    	$expense->amount=request('amount');
    	$expense->dinars=request('dinars')*1000;
    	$expense->dollars=request('dollars');
    	$expense->note=request('note');
    	    	
        $expense->created_at=Carbon::today();
      
    	$expense->branch_id=\Auth::user()->branch->id;
    	if($expense->save())
    		\Session::flash('message',$message);
    	return redirect('/expenses');
    }

    public function search(Request $request)
    {
      if($request->has('start_date') && $request->has('end_date') && $request->has('branch_id')!=0)
      {
        $branch_id=Request('branch_id');
        if(\Auth::user()->type!='admin')
        {
          $branch_id=\Auth::user()->branch_id;
        }
        
        $expenses=Expense::whereDate('created_at','>=',$request['start_date'])
                      ->whereDate('created_at','<=',$request['end_date'])
                      ->where('branch_id','like','%'.$branch_id.'%')->paginate(150);
      }
      elseif((!$request->has('start_date') || !$request->has('end_date')) &&($request->has('branch_id')!=0))
      {
        $branch_id=Request('branch_id');
          if(\Auth::user()->type!='admin')
        {
          $branch_id=\Auth::user()->branch_id;
        }
        $expenses=Expense::where('branch_id','like','%'.$branch_id.'%')->paginate(150);
      }
      elseif($request->has('start_date') && $request->has('end_date') && ($request->has('branch_id')==0))
      {
          if(\Auth::user()->type!='admin')
        {
          $branch_id=\Auth::user()->branch_id;
        }
          
           $expenses=Expense::whereDate('created_at','>=',$request['start_date'])
                        ->whereDate('created_at','<=',$request['end_date'])
                       ->paginate(150);
      }
      else
      {
          return redirect('/expenses');
      }
        $searchExpenses=$expenses;
         return view('expenses.expenseHome',compact('searchExpenses'));
    }

    public function searchReason(Request $request)
    {
      if($request->has('reason'))
      {
        $expenses=Expense::where('reason','like','%'.$request['reason'].'%')->paginate(500);
      }
      else
      {
        return back();
      }
      $searchExpenses=$expenses;
         return view('expenses.expenseHome',compact('searchExpenses'));
    }
    
    public function searchUser(Request $request)
    {
        $expenses=Expense::where('user_id',$request['user_id'])->paginate(500);
        $searchExpenses=$expenses;
        return view('expenses.expenseHome',compact('searchExpenses'));
    }
    public function expenseByCategory(Request $request)
    {
        $from=$request['from'];
        $to=$request['to'];
        $expenses=DB::table('expenses')->select('reason',DB::raw('sum(amount) as sum'))->groupBy('reason')->orderBy(DB::raw('sum'),'desc')->get();
        return view('reports.expenseByCategory',compact(['expenses','from','to']));
       // $expense=Expense::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->groupBy('reason')->get();
    }
}
