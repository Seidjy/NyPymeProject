<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_participant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('novo_cpf', 40);
            $table->string('antigo_cpf', 40);
            $table->integer('nova_pontuacao');
            $table->integer('antiga_pontuacao');
            $table->string('usuario', 40);
            $table->string('ip', 40);
            $table->string('action', 40);
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
        Schema::dropIfExists('log_participant');
    }
}
