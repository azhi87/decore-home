<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class Customer extends Model
{


    public function scopeNotDeleted($query)
    {
        return $query->where('deleted', '=', 'active');
    }
    public function garak()
    {
    	return $this->belongsTo('\App\Garak');
    }

    public function sales()
    {
    	return $this->hasMany('\App\Sale');
    }

    public function installments()
    {
        return $this->hasMany('\App\Installment','customer_id');
    }

    public function debts()
    {
    	return $this->hasMany('\App\Debt');
    }
    
    public function filters()
    {
        return $this->hasMany('\App\Filters');
    }
    public function customerDebt()
    {
    	$total= $this->sales()->sum('total');
    	$paid=$this->sales->sum('calculatedPaid');
    	$repaid=$this->debts->sum('calculatedPaid');
        $installments=DB::table('installments')->where('customer_id',$this->id)->sum('calculatedPaid');
        
    	return round(($total-($paid+$repaid)),2);
    }
    public function returns()
    {
        return $this->hasMany('\App\Ireturn');
    }
    public function totalReturnsRemainedPrice()
    {
       return DB::table('ireturns')->where('payback','0')
                                ->where('customer_id',$this->id)
                                ->sum(DB::raw('(ppi * quantity)'));
    }
    public function daysFromLastDebtPayment()
    {
        if (count($this->debts->max('created_at'))) 
        { 
        return $this->debts->max('created_at')->diffInDays(Carbon::now());
        }
        else
        {
            return 'قەرزدانەوەی نیە';
        }
    }
    public function bgChange()
    {
        if($this->daysFromLastDebtPayment()>=20 && $this->daysFromLastDebtPayment()<40)
            return 'bg-yellow';
        elseif($this->daysFromLastDebtPayment()>=40)
        {
            return 'bg-red';
        }
    }
    public function hasUnConfirmedDebts()
    {
        $count=\App\Debt::where('status','0')->where('customer_id',$this->id)->count();
        if($count>0)
            {
                return true;
            }
        else
            {
                return false;
            }
        
    }
    public function typeText()
    {
        if($this->type=='dwkan')
            return 'دووکان';
        else
            return 'ماڵ';
    }

}
?>