<?php

namespace App\Http\Controllers;

use App\Category;
use App\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockByCat(Request $request)
    {
        $cat = Category::with('subcategories')->findOrFail($request['cat_id']);
        $suppliers = Supplier::all();
        return view('reports.stock-by-cat', compact('cat', 'suppliers'));
    }
}
