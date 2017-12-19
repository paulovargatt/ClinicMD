<?php

use Illuminate\Database\Seeder;
use App\Paciente;
class PacienteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPacientes();
    }


    private function createPacientes()
    {
        $max = rand(50, 60);
        for($i=0; $i < $max; $i++):
            $this->createPaciente($i);
        endfor;
        $this->command->info($max . ' demo Pacientes created');
    }


    private function createPaciente($index)
    {
        return Paciente::create([
            'nome'  =>'Paciente '. $index,
            'prontuario'  => '123',
            'nascimento'  => '1990-01-01 00:00:05',
            'sexo' => 'masculino',
            'est_civil' => 'casado',
            'city_id' => '7994',
            'uf' => 'rs',
            ]);
    }
}
