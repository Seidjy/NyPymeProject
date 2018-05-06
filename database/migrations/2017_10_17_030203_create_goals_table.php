<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnpj', 14);
            $table->string('name', 40);
            $table->integer('idRuleToAchieve')->unsigned();
            $table->integer('idRuleToRestrict')->unsigned();
            $table->integer('idRuleToAward')->unsigned();
            $table->timestamps();
            $table->foreign('idRuleToAchieve')->references('id')->on('rules_to_achieves');
            $table->foreign('idRuleToRestrict')->references('id')->on('rules_to_restricts');
            $table->foreign('idRuleToAward')->references('id')->on('rules_to_awards');
            $table->foreign('cnpj')->references('cnpj')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
