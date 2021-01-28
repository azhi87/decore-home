<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('sale_price');
            $table->double('min',10,2);
            $table->double('purchase_price',10,2);
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->integer('category_id');
            $table->integer('supplier_id');
           // $table->string('image_url');
            $table->enum('status',['1','0'])->default('1');
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
        Schema::dropIfExists('items');
    }
}
