<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::get('/', function () {
	return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
	return view('main.index');
})->middleware('auth');
Route::get('/logout', function () {
	\Auth::logout();
	return redirect('/login');
});

Route::middleware(['auth', 'maxzan'])->group(function () {

	Route::get('/items/add/{id?}', 'ItemController@index');
	Route::get('/items/edit/{id}', 'ItemController@edit');
	Route::post('/items/update/{id}', 'ItemController@store');
	Route::post('/cats/add', 'ItemController@addCategory');
	Route::post('/items/search', 'ItemController@search');
	Route::post('/items/searchName', 'ItemController@searchName');
	Route::post('/items/store', 'ItemController@store');
	Route::post('/reports/stock', function () {
		$cat_id = Request('cat_id');
		if (empty($cat_id) || $cat_id == 0) {
			$items = \App\Item::notDeleted()->get();
		} else {
			$items = \App\Item::notDeleted()->where('category_id', $cat_id)->get();
		}
		return view('reports.stock', compact('items'));
	});

	Route::post('/reports/stockWord', function () {
		$items = \App\Item::notDeleted()->where('name', 'like', '%' . Request('item_name') . '%')->get();
		return view('reports.stock', compact(['items']));
	})->middleware('auth');

	Route::post('/reports/stockCode', function () {
		$items = \App\Item::where('id', Request('item_id'))->get();
		return view('reports.stockCode', compact(['items']));
	});

	Route::get('/reports/stock', function () {
		$items = \App\Item::notDeleted()->get();
		return view('reports.stock', compact(['items']));
	});

	Route::get('/reports/stockEmpty', function () {
		$items = \App\Item::notDeleted()->get();
		return view('reports.stockEmpty', compact(['items']));
	});
});



Route::middleware(['auth', 'accountant'])->group(function () {
    
	Route::get('/sale/seeDeletedSales', 'SaleController@seeDeletedSales');

	Route::post('/reports/qistByDate', 'SaleController@qistByDateReport');
	Route::get('/expense/export', 'ExportController@export')->name('expense.export');
	Route::get('/expenses', 'ExpenseController@index');
	Route::post('/expenses/store/{id}', 'ExpenseController@store');
	Route::post('/expenses/store/', 'ExpenseController@store');
	Route::post('/expenses/search', 'ExpenseController@search');
	Route::post('/expenses/searchReason', 'ExpenseController@searchReason');
	Route::post('/expenses/searchUser', 'ExpenseController@searchUser');
	Route::post('/reports/expenseByCategory', 'ExpenseController@expenseByCategory');
	Route::get('/expenses/edit/{id}', function ($id) {
		$expense = \App\Expense::find($id);
		return view('expenses.expenseUpdate', compact('expense'));
	});

	route::get('/xwastns', 'XwastnController@index');
	route::post('/xwastn/store', 'XwastnController@store');
	route::get('/xwastn/add', 'XwastnController@add');
	route::get('/xwastn/delete/{id}', 'XwastnController@delete');

	Route::get('/sales/addSale', 'SaleController@index');
	Route::post('/sale/create', 'SaleController@create');
	// Route::post('/sale/create',function(){
	// 		dd('fuck');
	// });
	Route::get('/sale/seeSales/{id?}', 'SaleController@seeSales');
	Route::get('/sale/initials', 'SaleController@seeInitials');
	Route::get('/sale/print/{index}', 'SaleController@salePrint');
	Route::get('/sale/printt/{index}', 'SaleController@salePrintt');

	Route::post('/sale/update/{id}', 'SaleController@create');
	Route::post('/sale/accountantUpdate/{id}', 'SaleController@accountantUpdateSale');
	Route::post('/sales/export', 'ExportController@export');

	Route::get('/sale/transfer/{id}', 'SaleController@transfer');
	Route::get('/sale/support/{id}', 'SaleController@support');
	Route::get('/sale/home', function () {
		return view('sales.saleHome');
	});


	Route::get('sale/search', function () {
		return view('sales.searchSale');
	});
	Route::post('/sale/search', 'SearchController@searchSale');



	Route::get('/sale/confirm/{user_id?}', function ($user_id = 0) {
		if ($user_id == 0) {
			$sales = \App\Sale::where('status', '0')->latest()->paginate(20);
		} else {
			$sales = \App\Sale::where('status', '0')->where('user_id', $user_id)->latest()->paginate(20);
		}
		return view('sales.seeSales', compact('sales'));
	});

	Route::get('/sales/noSupport', function () {

		if (\Auth::user()->type == 'admin') {
			$sales = \App\Sale::where('support', '0')->latest()->paginate(20);
		} else {
			$sales = \App\Sale::where('branch_id', \Auth::user()->branch_id)->where('support', '0')->latest()->paginate(20);
		}



		return view('sales.seeSales', compact('sales'));
	});

	Route::get('/sale/update/{index}', function ($index) {
		$sale = \App\Sale::find($index);
		if (\Auth::user()->type != 'admin')
			return view('sales.accountant_update_sale', compact('sale'));
		return view('sales.updateSale', compact('sale'));
	});


	Route::get('/purchases/ItemPrice', 'ItemController@getItemPrice');
	Route::get('/purchases/ItemPurchasePrice', 'ItemController@getItemPurchasePrice');


	Route::get('/installments/{id?}', 'InstallmentController@index');
	Route::get('/installments/addOneInstallment/{id?}', 'InstallmentController@addOneInstallment');
	Route::post('/installments/update', 'InstallmentController@update');
	Route::post('/installments/store', 'InstallmentController@store');
	Route::get('/installments/dl/{id}', 'InstallmentController@delete');
	Route::post('/installments/sid/', 'InstallmentController@searchBySid');
	Route::post('/installments/tel/', 'InstallmentController@searchByTel');
	Route::get('/installments/print/{id}', 'InstallmentController@prnt');

	Route::post('/reports/stpSale', 'SearchController@stpSalePurchase');
	Route::get('/installments/edit/{id}', 'InstallmentController@edit');
	Route::get('/reports/due', 'InstallmentController@dueInstallments');
	Route::post('/reports/sms', 'SMSController@report');

	Route::get('/customers/edit/{id}', function ($id) {
		$customer = \App\Customer::find($id);
		return view('customers.customerUpdate', compact('customer'));
	});
	Route::get('/customers/customerNameById', 'CustomerController@getDetails');
	Route::get('/customers', 'CustomerController@index');
	Route::post('/customers/search', 'CustomerController@search');
	Route::get('/customers/searchGarak', 'CustomerController@searchGarak');

	Route::get('/reports', function () {
		return view('reports.reportHome');
	});

	Route::get('/reports/installment', 'InstallmentController@report');
	Route::get('/installments/send/{id}', 'InstallmentController@send');
	Route::post('/reports/due', 'InstallmentController@dueInstallmentsByDate');


	Route::post('/reports/stock', function () {
		$cat_id = Request('cat_id');
		if (empty($cat_id) || $cat_id == 0) {
			$items = \App\Item::notDeleted()->get();
		} else {
			$items = \App\Item::notDeleted()->where('category_id', $cat_id)->get();
		}
		return view('reports.stock', compact('items'));
	});

	Route::post('/reports/stockCode', function () {
		$items = \App\Item::where('id', Request('item_id'))->get();
		return view('reports.stockCode', compact(['items']));
	});

	Route::get('/reports/stock', function () {
		$items = \App\Item::notDeleted()->get();
		return view('reports.stock', compact(['items']));
	});

	Route::get('/reports/stockEmpty', function () {
		$items = \App\Item::notDeleted()->get();
		return view('reports.stockEmpty', compact(['items']));
	});
});

// ************************************************************
Route::middleware(['auth', 'admin'])->group(function () {
	Route::post('/reports/supplierDebt', function () {
		$suppliers = \App\Supplier::all();
		return view('reports.supplierDebt', compact('suppliers'));
	});


	Route::get('/purchases/add', function () {
		return view('purchases.addPurchase');
	});

	Route::get('/peripheralUpdates', function () {
		return view('items.peripheralUpdates');
	});

	Route::post('/category/edit/{id}', function ($id) {
		$category = \App\Category::find($id);
		$category->category = Request('category');
		$category->save();
		\Session::flash('message', 'جۆری مەوادەکە بەسەرکەوتووی گۆڕڕا');
		return redirect('/peripheralUpdates');
	});


	Route::post('/customers/store', 'CustomerController@store');
	Route::post('/customers/store/{id}', 'CustomerController@store');
	Route::post('/customers/addGarak', 'CustomerController@addGarak');
	Route::post('/customers/addCity', 'CustomerController@addCity');

	Route::post('/rate/add', 'RateController@create');
	Route::post('/rate', function () {
		$rate = new \App\Rate;
		$rate->rate = Request('rate');
		$rate->user_id = \Auth::user()->id;
		$rate->save();
		return redirect('/');
	});

	Route::get('/suppliers', 'SupplierController@index');
	Route::post('/suppliers/search', 'SupplierController@search');
	Route::post('/suppliers/store/{id?}', 'SupplierController@store');
	Route::get('/suppliers/edit/{id}', 'SupplierController@edit');


	Route::post('/reports/supplierSale', function () {
		$to = Request('to');
		$from = Request('from');
		$items = \App\Item::notDeleted()->where('supplier_id', Request('supplier_id'))->get();
		$name = \App\Supplier::find(Request('supplier_id'))->name;
		return view('reports.supplierSale', compact(['items', 'from', 'to', 'name']));
	});


	Route::post('/reports/mandwb', 'ItemController@mandwbReports');

	Route::post('/reports/mandwbSales', 'SaleController@mandwbSaleReport');
	Route::post('/reports/froshyarReport', 'SaleController@froshyarReport');
	Route::post('/reports/income', 'DebtController@income');

	Route::get('/transfers', 'TransferController@index');
	Route::post('/transfers/store/{id?}', 'TransferController@store');
	Route::get('/transfers/edit/{id}', 'TransferController@edit');
	Route::get('/transfers/print/{id}', 'TransferController@printing');
	Route::post('/transfers/searchByDate', 'TransferController@searchByDate');
	Route::post('transfers/searchBySupplier', 'TransferController@searchBySupplier');

	Route::post('/purchase/create', 'PurchaseController@store');
	Route::post('/purchase/update/{id}', 'PurchaseController@update');
	Route::get('/purchase/edit/{id}', 'PurchaseController@edit');
	Route::get('purchase/see/{id?}', 'PurchaseController@index');
	Route::get('/purchase/search', 'PurchaseController@search');
	Route::post('/purchase/search', 'PurchaseController@search');
	Route::get('/purchase/delete/{id}', 'PurchaseController@delete');

	Route::get('/paybacks', 'PaybackController@index');
	Route::post('/paybacks/store/{id?}', 'PaybackController@store');
	Route::get('/paybacks/edit/{id}', 'PaybackController@edit');
	Route::get('/sale/delete/{id}', 'SaleController@destroy');

	Route::get('/users/edit/{id}', function ($id) {
		$user = \App\User::find($id);
		$cats = \App\Category::all();
		return view('auth.updateUser', compact(['user', 'cats']));
	});

	Route::post('/users/update/{id}', 'UserController@updateUser');
	Route::get('/users', function () {
		$users = \App\User::all();
		return view('auth.showUsers', compact('users'));
	});

	Route::get('/users/toggle/{id}', function ($id) {
		$user = \App\User::find($id);
		$user->toggleStatus();
		return redirect('/users');
	});

	Route::post('/reports/profit', 'SearchController@allProfit');
	Route::post('/reports/profitByItemByDate', function () {
		$items = \App\Item::notDeleted()->get();
		$to = Request('to');
		$from = Request('from');
		return view('reports.profitByItemByDate', compact(['items', 'from', 'to']));
	});

	Route::get('reports/stockValuation', function () {
		$items = \App\Item::notDeleted()->get();
		return view('reports.stockValuation', compact('items'));
	});
	Route::post('/reports/stpReport', 'SearchController@stpReport');
});
