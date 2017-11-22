<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesToAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules_to_awards', function (Blueprint $table) {
            $table->string('id',32);
            $table->string('cnpj', 14);
            $table->string('name',40);
            $table->integer('idTypeAward')->unsigned();
            $table->integer('amount');
            $table->timestamps();
            $table->foreign('idTypeAward')->references('id')->on('type_awards');
            $table->foreign('cnpj')->references('cnpj')->on('users');
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
        Schema::dropIfExists('rules_to_awards');
    }
}