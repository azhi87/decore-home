<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payback extends Model
{
    public function user()
    {
    	return $this->belongsTo('\App\User','user_id');
    }
    public function currencyText()
    {
    	if($this->currency=='$')
    	{
    		return 'دۆلار';
    	}
    	else
    	{
    		return 'دینار';
    	}
    }
}
