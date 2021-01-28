<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->double('total',10,2);
            $table->double('extra',10,2)->default(0);
            $table->double('discount',10,2)->default(0);
            $table->double('paid',10,2)->default(0);
            $table->double('paid');
            $table->text('description')->nullable();
            $table->integer('invoice_no')->nullable();
            $table->integer('supplier_id');
            $table->timestamps();
        });

         Schema::create('purchase_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id');
            $table->string('item_id');
            $table->double('quantity');
            $table->double('ppi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
        Schema::dropIfExists('purchases');
    }
}
