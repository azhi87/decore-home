<?php

namespace App\Http\Controllers;

use DB;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\ExpenseExporter;

class ExpenseController extends Controller
{
  public $user;
  public function __construct()
  {
    if (\Auth::check()) {
      $this->user = \Auth::user();
    }
  }

  public function index()
  {
    $expenses = Expense::where('branch_id', \Auth::user()->branch_id)->latest()->paginate(25);
    return view('expenses.expenseHome', compact('expenses'));
  }

  public function store($id = 0)
  {
    $this->validate(request(), [
      "amount" => "required",
    ]);
    if ($id == 0) {
      $expense = new Expense();
      $expense->user_id = \Auth::user()->id;
      $message = 'مەصروفاتەکە بەسەرکەوتوویی زیادکرا';
    } else {
      $expense = Expense::findOrFail($id);
      $message = 'گۆڕانکاریەکە بەسەرکەوتوویی تۆمارکرا';
    }

    if (!is_null(request('reason_new'))) {
      DB::table('reasons')->insert(['name' => request('reason_new')]);
      $expense->reason = request('reason_new');
    } else {
      $expense->reason = request('reason');
    }
    $expense->amount = request('amount');
    $expense->dinars = request('dinars') * 1000;
    $expense->dollars = request('dollars');
    $expense->note = request('note');

    // $expense->created_at = Carbon::today();

    $expense->branch_id = \Auth::user()->branch->id;
    if ($expense->save())
      \Session::flash('message', $message);
    return redirect('/expenses');
  }

  public function search(Request $request)
  {
    $expenses = Expense::query();
    $from = $request['start_date'];
    $to = $request['end_date'];
    $branch_id = $request['branch_id'];
    if (isset($from))
      $expenses->whereDate('created_at', '>=', $from);
    if (isset($to))
      $expenses->whereDate('created_at', '<=', $to);
    if (isset($branch_id) && $branch_id != 0) {
      $expenses->where('branch_id', $branch_id);
    } else {
      $expenses->where('branch_id', auth()->user()->branch_id);
    }
    $searchExpenses = $expenses->paginate(300);
    if (isset($request['excel']))
      return \Excel::download(new ExpenseExporter($searchExpenses), 'مەصروفات.xlsx');
    else
      return view('expenses.expenseHome', compact('searchExpenses'));
  }

  public function searchReason(Request $request)
  {
    if ($request->has('reason')) {
      $expenses = Expense::where('reason', 'like', '%' . $request['reason'] . '%')->paginate(500);
    } else {
      return back();
    }
    $searchExpenses = $expenses;
    return view('expenses.expenseHome', compact('searchExpenses'));
  }

  public function searchUser(Request $request)
  {
    $expenses = Expense::where('user_id', $request['user_id'])->paginate(500);
    $searchExpenses = $expenses;
    return view('expenses.expenseHome', compact('searchExpenses'));
  }
  public function expenseByCategory(Request $request)
  {
    $from = $request['from'];
    $to = $request['to'];
    $expenses = DB::table('expenses')->select('reason', DB::raw('sum(amount) as sum'))->groupBy('reason')->orderBy(DB::raw('sum'), 'desc')->get();
    return view('reports.expenseByCategory', compact(['expenses', 'from', 'to']));
    // $expense=Expense::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->groupBy('reason')->get();
  }
}
