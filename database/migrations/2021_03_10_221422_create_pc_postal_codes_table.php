<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcPostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_postal_codes', function (Blueprint $table) {
            $table->id();
            $table->string('cod_district')->comment('Conteúdo: Código do Distrito');
            $table->string('cod_county')->comment('Conteúdo: Código do Concelho');
            $table->string('cod_local')->comment('Conteúdo: Código da localidade');
            $table->string('local')->comment('Conteúdo: Localidade');
            $table->string('cod_art')->comment('Conteúdo: Código da Artéria');
            $table->string('type_art')->nullable()->comment('Conteúdo: Tipo da artéria (Rua, Praça, etc)');
            $table->string('first_prep')->nullable()->comment('Conteúdo: Primeira preposição');
            $table->string('title_art')->nullable()->comment('Conteúdo: Título artéria (Doutor, Eng. Professor, etc)');
            $table->string('second_prep')->nullable()->comment('Conteúdo: Segunda preposição');
            $table->string('desig_art')->nullable()->comment('Conteúdo: Designação');
            $table->string('local_art')->nullable()->comment('Conteúdo: Informação do local/zona');
            $table->string('troco')->nullable()->comment('Conteúdo: troço');
            $table->string('door')->nullable()->comment('Conteúdo: Número da porta do cliente');
            $table->string('client')->nullable()->comment('Conteúdo: Nome do cliente');
            $table->string('cp4')->comment('Conteúdo: Número do código postal');
            $table->string('cp3')->comment('Conteúdo: Extensão do número do código postal');
            $table->string('cpalf')->comment('Conteúdo: Designação postal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_postal_codes');
    }
}
