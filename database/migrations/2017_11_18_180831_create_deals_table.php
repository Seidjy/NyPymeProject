<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnpj', 14);
            $table->string('idCustomer', 32);
            $table->integer('idTypeTransactions')->unsigned();
            $table->string('idGoals',32)->nullable($value = true);
            $table->string('idPrize',32)->nullable($value = true);
            $table->decimal('amount',10,2)->nullable($value = true);
            $table->timestamps();
            $table->foreign('idCustomer')->references('id')->on('customers');
            $table->foreign('idGoals')->references('id')->on('goals');
            $table->foreign('idTypeTransactions')->references('id')->on('type_transactions');
            $table->foreign('idPrize')->references('id')->on('prizes');
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
        Schema::dropIfExists('deals');
    }
}
