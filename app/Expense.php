<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Expense extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }
    public function formattedAmount()
	{
    	return number_format($this->attributes['amount']);
	}
	public function totalToday()
    {
        return $this->where('branch_id',\Auth::user()->branch_id)->whereDate('created_at',Carbon::today())->sum('amount');

    } 

	public function scopeSearchFilter($query,$request)
    {
    	if($request->has('start_date'))
    		$query=$query->where('created_at','>=',$request['start_date']);
    	if($request->has('end_date'))
    		$query=$query->where('created_at','<=',$request['end_date']);
    	if($request->has('user_id'))
    		$query=$query->where('user_id','>=',$request['user_id']);
        
        return $query;
    }

}
