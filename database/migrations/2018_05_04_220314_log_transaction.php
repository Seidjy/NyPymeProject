<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',40);
            $table->string('users_premio',40);
            $table->foreign('idParticipant',40);
            $table->string('valor_pontos_antes', 4);
            $table->string('valor_pontos_depois',4);
            $table->string('data',10);
            $table->string('name_premium',40);
            $table->integer('idTypeAward')->unsigned();
            $table->integer('amount');
            $table->timestamps();
            $table->foreign('idTypeAward')->references('id')->on('type_awards');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_transaction');
    }
}
