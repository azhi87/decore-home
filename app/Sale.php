<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Sale extends Model
{
    // public function currentInstallment()
    // {
    //     return $this->hasOne('\App\Installments','sale_id')
    //                 ->where('calculatedPaid',0)
    //                 ->whereDate('created','>=',Ca)
    //                 ->latest();
    // }
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
	public function branch()
	{
		return $this->belongsTo('App\Branch');
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
	public function countUnConfirmed($branch_id=0)
	{
	    if($branch_id!=0)
	    {
	       return $this->where('status','0')->where('branch_id',$branch_id)->count(); 
	       
	    }
        else
        {
          return $this->where('status','0')->count();  
        }
		
	} 
	
	public function totalToday()
	{
		if(\Auth::user()->type=='admin')
			{
				return $this->whereDate('created_at',Carbon::today())->sum('total');
			}
			else
			{
				return $this->where('branch_id',\Auth::user()->branch_id)->whereDate('created_at',Carbon::today())->sum('total');
			}
		

	} 
	public function countToday()
	{
		if(\Auth::user()->type=='admin')
			{
				return $this->whereDate('created_at',Carbon::today())->count();
			}
			else
			{
				return $this->where('branch_id',\Auth::user()->branch_id)->whereDate('created_at',Carbon::today())->count();
			}

	} 
		public function countNoSupport()
	{
	    if(\Auth::user()->type=='admin')
	    {
	       return $this->where('support','0')->count();
	    }
	    else
	   {
	   		return $this->where('branch_id',\Auth::user()->branch_id)->where('support','0')->count();
	   }
	    
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
	
	public function supportText()
	{
		if($this->support=='0')
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
			return ' قیستی '.$this->installments. ' مانگ';
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
	public function transferDate()
	{
	    if($this->status=='1')
	    {
	        return $this->updated_at;
	    }
	    else
	    {
	        return '';
	    }
	}

}
