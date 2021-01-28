<?php

namespace App;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status','branch_id','type','mobile','group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function rates()
    {
        return $this->hasMany('\App\Rate');
    }
    public function paybacks()
    {
        return $this->hasMany('\App\Payback','user_id');
    }
    public function expenses()
    {
        return $this->hasMany('\App\Expense','user_id');
    }

    public function installments()
    {
        return $this->hasMany('\App\Installment','user_id');
    }

    public function branch()
    {
        return $this->belongsTo('\App\Branch','branch_id');
    }
    

    public static function users($type=0)
    {
        if($type===0)
        {
            return \App\User::get();    
        }
        else
        {
            return \App\User::where('type',$type)->get();
        }
    }



    public function sales()
    {
        return $this->hasMany('\App\Sale');
    }
    
    public function branchs()
    {
        if($this->branch_id==1)
        {
            return 'فەرعی یەک';
        }
        if($this->branch_id==2)
        {
            return 'فەرعی دوو';
        }
        
    }
    
    public function typeText()
    {
        if($this->type=='admin')
        {
            return 'ئەدمین';
        }
        if($this->type=='accountant')
        {
            return 'محاسب';
        }
        if($this->type=='accountant_high')
        {
            return 'محاسب باڵا';
        }
        if($this->type=='mandwb')
        {
            return 'مەندوب';
        }
        if($this->type=='driver')
        {
            return 'شۆفێر';
        }
        if($this->type=='supervisor')
        {
            return 'سەرپەرشتیار';
        }
        if($this->type=='maxzan')
        {
            return 'سەرپەرشتیاری مەخزەن';
        }
    }
    public function toggleStatus()
    {
        if($this->status=="1")
            $this->status="0";
        elseif($this->status=="0")
        {
            $this->status="1";
        }
        $this->save();
    }
    // public function totalUnconfirmedDollars()
    // {
    //     return DB::table('debts')->where('user_id',$this->id)
    //                              ->where('status','0')
    //                              ->sum('dollars');
    // }
    //  public function totalUnconfirmedDinars()
    // {
    //     return DB::table('debts')->where('user_id',$this->id)
    //                             ->where('status','0')
    //                             ->sum('dinars');
    // }

    public function balance()
    {
       
        $sales=DB::table('sales')->where('user_id',$this->id)
                                 ->sum('calculatedPaid');
        $qists=DB::table('installments')->where('user_id',$this->id)
                                         ->sum('calculatedPaid');
        $paybacks=DB::table('paybacks')->where('user_id',$this->id)
                                        ->sum('paid');

        return ($sales+$qists)-($paybacks);
    }
    
   

}
