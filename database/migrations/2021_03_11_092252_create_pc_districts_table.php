<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_districts', function (Blueprint $table) {
            $table->id();
            $table->string('cod_district')->comment('Conteúdo: Código do Distrito');
            $table->string('desig_district')->comment('Conteúdo: Designação do Distrito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_districts');
    }
}
