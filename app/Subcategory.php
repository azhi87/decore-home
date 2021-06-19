<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategory extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stock()
    {
        $bought = DB::table('items')
            ->join('purchase_items', 'purchase_items.item_id', 'items.id')
            ->where('items.subcategory_id', $this->id)
            ->sum('purchase_items.quantity');

        $sold = DB::table('items')
            ->join('sale_items', 'sale_items.item_id', 'items.id')
            ->where('items.subcategory_id', $this->id)
            ->sum('sale_items.quantity');
        return $bought - $sold;
    }
}
