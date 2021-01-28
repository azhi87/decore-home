<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DB;
use \App\Sale;
class Item extends Model
{
    protected $guarded=[];
    public $incrementing=false;
    public function scopeNotDeleted($query)
    {
        return $query->where('status', '=', '1');
    }

    public function sales()
    {
        return $this->belongsToMany('App\Sale','sale_items')->withPivot('quantity','ppi')->withTimestamps();
    }
    public function category()
    {
      return $this->belongsTo('App\Category','category_id');
    }

    public function totalPurchase()
    {
      return DB::table('purchase_items')->where('item_id',$this->id)->sum('quantity');
    }
    public function totalSale()
    {
           return DB::table('sale_items')->where('item_id',$this->id)
                                          ->join('sales','sale_items.sale_id','=','sales.id')
                                          ->sum('quantity');
    }
    
     public function totalSaleByDate($from,$to)
    {
      
        return DB::table('sale_items')->where('item_id',$this->id)
                                      ->whereDate('created_at','>=',$from)
                                      ->whereDate('created_at','<=',$to)
                                      ->sum('quantity');
    }

     public function totalSaleByDateByBranch($from,$to,$branch_id)
    {
      
        return DB::table('sale_items')->where('item_id',$this->id)
                                      ->whereDate('sales.created_at','>=',$from)
                                      ->whereDate('sales.created_at','<=',$to)
                                      ->join('sales','sale_items.sale_id','=','sales.id')
                                        ->where('sales.branch_id',$branch_id)
                                      ->sum('quantity');
    }

    public function supplier()
    {
        return $this->belongsTo('\App\Supplier');
    }
    public function ireturns()
    {
        return $this->hasMany('\App\Ireturn');
    } 
   
    public function averagePurchasePrice()
    {
        $sumPrice=DB::table('purchase_items')->where('item_id',$this->id)
                                          ->sum(DB::raw('(ppi * quantity)'));
        $sumQuantity=DB::table('purchase_items')->where('item_id',$this->id)
                                          ->sum('quantity');
        if($sumQuantity==0)
        {
            $sumQuantity=1;
        }
        return $sumPrice/$sumQuantity;

    }
    public function totalProfit($from,$to)
    {
       $sumPrice=DB::table('sale_items')->where('item_id',$this->id)
                                        ->whereDate('created_at','>=',$from)
                                        ->whereDate('created_at','<=',$to)
                                        ->select(DB::raw(
                                          '(sum(ppi*quantity))/(sum(quantity)) as averageSalePrice'
                                          ))
                                        ->first();
      
        $sumQuantity=$this->totalSaleByDate($from,$to);
        return ($sumPrice->averageSalePrice-$this->averagePurchasePrice())*$sumQuantity;
    }
    
    public function totalProfitByBranch($from,$to,$branch_id)
    {
       $sumPrice=DB::table('sale_items')->where('item_id',$this->id)
                                        ->whereDate('sales.created_at','>=',$from)
                                        ->whereDate('sales.created_at','<=',$to)
                                        ->join('sales','sale_items.sale_id','=','sales.id')
                                        ->where('sales.branch_id',$branch_id)
                                        ->select(DB::raw(
                                          '(sum(ppi*quantity))/(sum(quantity)) as averageSalePrice'
                                          ))
                                        ->first();
      
        $sumQuantity=$this->totalSaleByDateByBranch($from,$to,$branch_id);
        return ($sumPrice->averageSalePrice-$this->averagePurchasePrice())*$sumQuantity;
    }

    public function boxesByUser($user_id,$from,$to)
    {
        return $this->sales()->where('mandwb_id',$user_id)
                             ->whereDate('sales.created_at','>=',$from)
                             ->whereDate('sales.created_at','<=',$to)
                             ->sum('quantity');
    }


    public function stock()
    {
            return $this->totalPurchase()-$this->totalSale();
    }

    
    public function formattedDescription()
    {
      return nl2br($this->description);
    }
    
    public function totalSaleIncludingSingles()
    {
      return $this->totalSale();
    }
    
}