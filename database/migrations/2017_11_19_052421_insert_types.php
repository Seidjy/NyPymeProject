<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('type_awards')->insert([
                'name' => 'Ponto'
            ]
        );
        DB::table('type_restricts')->insert([
                'name' => 'Dias'
            ]
        );
        DB::table('type_restricts')->insert([
                'name' => 'Sem restrição'
            ]
        );
        DB::table('type_achieves')->insert([
                'name' => 'Valor em reais'
            ]
        );
        DB::table('type_achieves')->insert([
                'name' => 'Conquista'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
