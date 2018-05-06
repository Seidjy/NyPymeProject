<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnpj', 14);
            $table->integer('idGoals')->unsigned();
            $table->integer('idCustomers')->unsigned();
            $table->integer('amountRestrict');
            $table->integer('amountStored');
            $table->timestamps();
            $table->foreign('idGoals')->references('id')->on('goals');
            $table->foreign('idCustomers')->references('id')->on('customers');
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
        Schema::dropIfExists('customer_goals');
    }
}

