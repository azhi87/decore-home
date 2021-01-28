<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{

	public function supplier()
	{
		return $this->belongsTo('\App\Supplier');
	}
	public function user()
	{
		return $this->belongsTo('\App\User','user_id');
	}
	public function typeText()
	{
		if($this->type==0)
			return 'ناردنی پارە';
		else
			return 'گەڕانەوەی پارە';
	}
}

