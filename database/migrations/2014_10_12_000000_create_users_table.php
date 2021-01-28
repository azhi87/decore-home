<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('status',[0,1]);
            $table->enum('type',['admin','accountant','supervisor','mandwb']);
            $table->integer('branch_id');
            $table->string('password');
            $table->string('mobile');
            $table->rememberToken();
            $table->timestamps();
        });

         DB::table('users')->insert([
            'id'=>1,'email'=>'azhi.faraj@gmail.com',
            'type'=>'admin',
            'status'=>'1',
            'branch_id'=>'1',
            'mobile'=>'07701505161',
            'name'=>'ئەژی فەرەج',
            'created_at'=>'2017-01-01',
            'password'=>(Hash::make(123456))
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
