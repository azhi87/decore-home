<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->double('dollars',10,2);
            $table->double('dinars');
            $table->double('rate');
            $table->integer('customer_id');
            $table->text('description')->nullable();
            $table->enum('status',['0','1'])->default('0');
            $table->double('calculatedPaid');
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
        Schema::dropIfExists('debts');
    }
}
