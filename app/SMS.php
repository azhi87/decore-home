<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
	protected $table="s_m_s";
	public function customer()
	{
		return $this->belongsTo('App\Customer','customer_id');
	} 

	public function installment()
	{
		return $this->belongsTo('App\Installment','installment_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}      
}
