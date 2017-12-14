<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('prontuario');
            $table->dateTime('cadastro');
            $table->dateTime('nascimento');
            $table->string('foto');
            $table->string('convenio');
            $table->string('matricula');
            $table->enum('sexo', ['masculino', 'feminino'] );
            $table->enum('est_civil', ['casado', 'solteiro','viuvo', 'separado'] );
            $table->string('indicacao');
            $table->string('identidade');
            $table->string('cpf');
            $table->string('email');
            $table->string('logradouro');
            $table->string('complemento');
            $table->string('bairro');
            $table->integer('city_id');
            $table->string('uf');
            $table->string('cep');
            $table->string('telefones');
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
        Schema::dropIfExists('pacientes');
    }
}
