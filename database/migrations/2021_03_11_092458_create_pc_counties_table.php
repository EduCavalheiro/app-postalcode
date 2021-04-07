<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_counties', function (Blueprint $table) {
            $table->id();
            $table->string('cod_district')->comment('Conteúdo: Código do Distrito');
            $table->string('cod_county')->comment('Conteúdo: Código do Concelho');
            $table->string('desig_county')->comment('Conteúdo: Designação do Concelho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_counties');
    }
}
