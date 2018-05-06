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
            $table->integer('idCustomer')->unsigned();
            $table->integer('idTypeTransactions')->unsigned();
            $table->integer('idGoals')->nullable()->unsigned();
            $table->integer('idPrize')->nullable()->unsigned();
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
