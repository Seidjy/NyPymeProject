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
            $table->string('id',32);
            $table->string('cnpj', 14);
            $table->string('idGoals',32);
            $table->string('idCustomers',32);
            $table->integer('amountRestrict');
            $table->integer('amountStored');
            $table->timestamps();
            $table->foreign('idGoals')->references('id')->on('goals');
            $table->foreign('idCustomers')->references('id')->on('customers');
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
        Schema::dropIfExists('customer_goals');
    }
}

