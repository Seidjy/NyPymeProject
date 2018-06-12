<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('novo_name', 40);
            $table->integer('novo_idRuleToAchieve');
            $table->integer('novo_idRuleToRestrict');
            $table->integer('novo_idRuleToAward');
            $table->string('antigo_name', 40);
            $table->integer('antigo_idRuleToAchieve');
            $table->integer('antigo_idRuleToRestrict');
            $table->integer('antigo_idRuleToAward');
            $table->string('ip',40);
            $table->string('action',40);
            $table->string('user', 40);

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
        Schema::dropIfExists('log_goals');
    }
}
