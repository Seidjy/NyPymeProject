<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogPrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_prize', function (Blueprint $table) {
            $table->increments('id');
            $table->string('novo_nome', 40);
            $table->string('antigo_nome', 40);
            $table->int('novo_preco');
            $table->int('antigo_preco');
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
        Schema::dropIfExists('log_prize');
    }
}
