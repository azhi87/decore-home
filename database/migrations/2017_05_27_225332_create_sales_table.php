<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->integer('installments');
            $table->string('driver')->nullable();
            $table->double('dinars');
            $table->double('dollars')->default(0);
            $table->double('rate')->defualt(1);
            $table->integer('mandwb_id');
            $table->double('calculatedPaid')->default(1);
            $table->double('total');
            $table->enum('completed',[0,1]);
            $table->double('discount')->default(0);
            $table->enum('status',['0','1'])->default('1');
            $table->support('support',['0','1'])->default('1');
            $table->timestamps();
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id');
            $table->string('item_id');
            $table->double('ppi');
            $table->double('quantity');
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
         Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
    }
}
