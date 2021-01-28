<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class Installment extends Model
{
    public function sale()
    {
    	return $this->belongsTo('\App\Sale','sale_id');
    }
    public function customer()
    {
    	return $this->belongsTo('\App\Customer','customer_id');
    }
    public function totalPaid($id)
    {
    	return DB::table('installments')->where('sale_id',$id)->sum(paid);
    }
    public function user()
    {
        return $this->belongsTo('\App\User','user_id');
    }
    public function messages()
    {
        return $this->hasMany('\App\SMS','installment_id');
    }

    public function countMessage()
    {
        if($a=$this::messages()->count())
            return $a;
            else
        return 0;
    }

    public function totalToday()
    {
        return $this->where('branch_id',\Auth::user()->branch_id)->whereDate('created_at',Carbon::today())->sum('calculatedPaid');

    } 
    public function countToday()
    {
        return $this->where('branch_id',\Auth::user()->branch_id)->whereDate('created_at',Carbon::today())->count();
    } 
    
    public function totalDue()
    {

        $ins=DB::select(DB::raw("SELECT count(id) as total from installments where calculatedPaid=0 and DATEDIFF(CURDATE(),(created_at))>=0"));
         return $ins[0]->total;
    }
    
}
