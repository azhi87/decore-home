<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Customer;
class Debt extends Model
{
	public function customer()
	{
		return $this->belongsTo('\App\Customer','customer_id');
	}
	public function user()
	{
		return $this->belongsTo('\App\User','user_id');
	}
	public function statusText()
	{
		if($this->status=='0')
		{
			return 'NO';
		}
		else
		{
			return 'OK';
		}
	} 
	public function countUnConfirmed()
	{
		return $this->where('status','0')->count();
	}
	  
}
