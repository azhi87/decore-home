<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	public function users()
	{
		return $this->hasMany('\App\User','branch_id');
	}
 }
