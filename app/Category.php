<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function Items()
	{
		return $this->hasMany('App\Item','category_id');
	}
	public static function relativeCats()
	{
		if(\Auth::user()->group!='dwkan' && \Auth::user()->type=='team_leader')
		{
			return \App\Category::where('name',\Auth::user()->group)->get();
		}
		else
		{
			return \App\Category::all();
		}
	}
	public function nameText()
	{
		if($this->name=='dwkan')
			return 'دوکان';
		elseif($this->name=='zahi')
		{
			return 'مەوادی پاککەرەوە';
		}
		elseif($this->name=='water')
		{
			return 'ئامێری ئاو';
		}
		elseif($this->name=='LED')
		{
			return 'ڕوناککەروەی لید';
		}
	}
	
    }
