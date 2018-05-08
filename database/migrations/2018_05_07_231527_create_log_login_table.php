<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_login', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user',100);
            $table->string('password',100);
            $table->string('ip',20);
            $table->integer('action')->default(1);
            $table->timestamps();
        });
    }

    //Action 1 = Sucesso

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_login');
    }
}