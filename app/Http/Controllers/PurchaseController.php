<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use Carbon\Carbon;
use DB;
class PurchaseController extends Controller
{

	public function index($id=0)
	{
		if($id==0)
		{
			$purchases=Purchase::latest()->paginate(30);
		}
		else
		{
			$purchases=Purchase::where('id',$id)->latest()->paginate(30);
		}
		return view('purchases.seePurchase',compact('purchases'));
	}

    public function add()
	{
		return view('purchases.addPurchase');
	}
	public function store(Request $request)
	{
		$howManyItems=$request['howManyItems'];
		$purchase=new Purchase();
		$purchase->supplier_id=$request['supplier_id'];
		$purchase->invoice_no=$request['invoice_no'];
		$purchase->total=$request['total'];
		$purchase->discount=$request['discount'];
		$purchase->extra=$request['extra'];
		$purchase->user_id=\Auth::user()->id;
		$purchase->paid=$request['paid'];
		$purchase->description=$request['description'];
		if($request->has('created_at'))
		{
		    $purchase->created_at=$request['created_at'];
		}
		$purchase->save();
		for($i=0; $i<=$howManyItems; $i++)
		{
			if($request->has('barcode'.$i))
			{
				$barcode=$request['barcode'.$i];
				$quantity=$request['quantity'.$i];
				$ppi=$request['ppi'.$i]+($request['ppi'.$i]*$request['extra']*0.01);
				$sale_price=$request['sppi'.$i];
				$item=\App\Item::find($barcode);
				if($barcode===0 || $ppi==0 || $quantity==0)
				{
					continue;
				}
				 $purchase->items()->attach($barcode,['ppi'=>$ppi,'quantity'=>$quantity]);
				 $item->sale_price=$sale_price;
				 $item->purchase_price=$ppi;
				 $item->save();
				
			}
		}
			$purchase->save();

		 return redirect('/purchase/see/'.$purchase->id);
	}
	
	public function search(Request $request)
	{

		
		if($request->has('purchase_id'))
		{
			return redirect('/purchase/see/'.$request['purchase_id']);
		}
		if($request->has('invoice_id'))
		{
		    $purchase_id=\App\Purchase::where('invoice_id',$request['invoice_id'])->pluck('id');
			return redirect('/purchase/see/'.$purchase_id);
		}
		$purchase=new Purchase();
		if($request->has('start_date') && $request->has('end_date'))
		{

			$purchases=$purchase::
								whereDate('created_at','>=',$request['start_date'])
								->whereDate('created_at','<=',$request['end_date'])
								->get();
		}
		else
		{
			$purchase=new Purchase();
			$purchases=$purchase::latest()->paginate(20);
		}
		return view('purchases.purchaseReports',compact('purchases'));
	}
	public function update(Request $request,$id)
	{
		$purchase=Purchase::find($id);
		$howManyItems=$request['howManyItems'];
		$purchase->supplier_id=$request['supplier_id'];
		$purchase->invoice_no=$request['invoice_no'];
		$purchase->total=$request['total'];
		$purchase->discount=$request['discount'];
		$purchase->extra=$request['extra'];
		$purchase->paid=$request['paid'];
		$purchase->save();
		 $purchase->items()->detach();
		for($i=0; $i<=$howManyItems; $i++)
		{
			if($request->has('barcode'.$i))
			{
				$barcode=$request['barcode'.$i];
				$quantity=$request['quantity'.$i];
				$ppi=$request['ppi'.$i];

				if($barcode===0 || $ppi===0 || $quantity===0)
				{
					continue;
				}
				 $purchase->items()->attach($barcode,['ppi'=>$ppi,'quantity'=>$quantity]);
				
			}
		}
			$purchase->save();
		 return redirect('/purchase/see/'.$purchase->id);
		return view('purchases.updatePurchase',compact('purchase'));
	}
	public function edit($id)
	{
		$purchase=Purchase::find($id);
		return view('purchases.updatePurchase',compact('purchase'));
	}
	public function delete($id)
	{
		DB::table('purchase_items')->where('purchase_id',$id)->delete();
		Purchase::destroy($id);
		return redirect('/purchase/see');
	}
}
