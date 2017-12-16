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
            $table->integer('prontuario')->nullable();;
            $table->dateTime('nascimento')->default('1990-01-01 00:00:00');
            $table->string('foto')->nullable();
            $table->string('convenio')->nullable();;
            $table->string('matricula')->nullable();;
            $table->enum('sexo', ['masculino', 'feminino'] );
            $table->enum('est_civil', ['casado', 'solteiro','viuvo', 'separado'] );
            $table->string('indicacao')->nullable();
            $table->string('identidade')->nullable();
            $table->string('cpf')->nullable();
            $table->string('email')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('complemento')->nullable();;
            $table->string('bairro')->nullable();
            $table->integer('city_id')->default('7994');
            $table->string('uf');
            $table->string('cep')->nullable();
            $table->string('telefones')->nullable();
            $table->softDeletes();
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
