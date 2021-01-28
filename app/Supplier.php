<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  public function purchases()
  {
      return $this->hasMany('\App\Purchase');
  }

  public function supplierDebt()
  {
      return $this->purchases->sum('total')-$this->purchases->sum('discount')-$this->purchases->sum('paid')-$this->transfers->sum('amount');
  }
  public function Transfers()
  {
      return $this->hasMany('\App\Transfer','supplier_id');
  }
 

}
