<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xwastn extends Model
{
    
    public function customer()
	{
		return $this->belongsTo('App\Customer','customer_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}
	public function branch()
	{
		return $this->belongsTo('\App\Branch','branch_id');
	}
}
