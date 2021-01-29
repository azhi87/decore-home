<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Helpers\Exporter;
use App\Helpers\ExpenseExporter;
use App\Helpers\SaleExporter;
use App\Sale;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $from = $request['from'];
        $to = $request['to'];
        $branch_id = $request['branch_id'];
        $sales = Sale::query();
        if ($branch_id != '0') {
            $sales->where('branch_id', $branch_id);
        }
        $sales->whereDate('created_at', '>=', $from);
        $sales->whereDate('created_at', '<=', $to);
        $sales = $sales->latest()->get();
        return \Excel::download(new SaleExporter($sales), 'invoices.xlsx');
    }
}
