<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class DeletedSale extends Model
{
	protected $table="deleted_sales";
    
	public function items()
	{
		return $this->belongsToMany('App\Item','sale_items')->withPivot('quantity','ppi')->withTimestamps();
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function mandwb()
	{
		return $this->belongsTo('App\User','mandwb_id','id');
	}
	public function customer()
	{
		return $this->belongsTo('App\Customer');
	}
	public function ins()
	{
		return $this->hasMany('\App\Installment','sale_id');
	}
	public function dueMoney()
	{

        return \App\Installment::where('calculatedPaid',0)
        ->whereDate('created_at','<',Carbon::today())
        ->where('sale_id',$this->id)
        ->sum('expectedPaid');
	}

	public function dueCount()
	{

        return \App\Installment::where('calculatedPaid',0)
        ->whereDate('created_at','<',Carbon::today())
        ->where('sale_id',$this->id)
        ->count();
	}
	public function countUnConfirmed()
	{
		return $this->where('status','0')->count();
	} 
	public function totalToday()
	{
		return $this->whereDate('created_at',Carbon::today())->sum('total');

	} 
	public function countToday()
	{
		return $this->whereDate('created_at',Carbon::today())->count();
	} 
		public function countNoSupport()
	{
		return $this->where('support','0')->count();
	} 
	
	public function statusText()
	{
		if($this->status=='0')
		{
			return'نەخێر';
		}
		else
		{
			return 'بەڵێ';
		}
	}
	
	

	
	public function qistType()
	{
		if($this->installments==0)
		{
			return 'نقد';
		}
		else
		{
			return ' قیستی '.$this->installments. ' مانگی';
		}

	}
	public function actualPaid()
	{
		if($this->installments!=0)
		{
			return $this->ins->sum('calculatedPaid')+$this->calculatedPaid;
		}
		else
		{
			return $this->calculatedPaid;
		}
	}

	public function remainedAmount()
	{
		return $this->total-($this->calculatedPaid+$this->ins->sum('calculatedPaid'));
	}

	
	public function quantity()
	{
		return $this->items->pivot->sum('quantity');
	}

	public function totalQist()
	{
		return \App\Sale::sum('total')-(\App\Sale::sum('calculatedPaid')+\App\Installment::sum('calculatedPaid'));
	}
	public function totalSupplierDebt()
	{
		return DB::table('purchases')->sum(DB::raw('(total- paid - discount)')) - DB::table('transfers')->sum('amount');
	}

}
