<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        $this->createAdmin();
        $this->createEnfermagem();
        $this->createMedica();
    }

    private function createAdmin()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'name'  => 'Administrador',
            'password' => bcrypt('123456'),
            'type' => '3'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('admin@gmail.com');
    }

    private function createEnfermagem()
    {
        User::create([
            'email' => 'enfermagem@gmail.com',
            'name'  => 'Enfermagem',
            'password' => bcrypt('123456'),
            'type' => '1'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('enfermagem@gmail.com');
    }


    private function createMedica()
    {
        User::create([
            'email' => 'medica@gmail.com',
            'name'  => 'Médica',
            'password' => bcrypt('123456'),
            'type' => '2'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('medica@gmail.com');
    }

}