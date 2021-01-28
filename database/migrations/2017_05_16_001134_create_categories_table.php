<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['id'=>1,'name'=>'قەنەفە','created_at'=>'2017-01-01'],
            ['id'=>2,'name'=>'مێز','created_at'=>'2017-01-01'],
            ['id'=>3,'name'=>'کەوانتەر','created_at'=>'2017-01-01'],
            ['id'=>4,'name'=>'ئاوێنە','created_at'=>'2017-01-01']
            
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
