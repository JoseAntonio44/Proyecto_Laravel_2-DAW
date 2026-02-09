<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run()
    {
        DB::table('alumnos')->insert([
            [
                'nombre' => 'Juan Pérez',
                'telefono' => '666123456',
                'edad' => 20,
                'password' => Hash::make('password123'),
                'email' => 'juan@ejemplo.com',
                'sexo' => 'M',
            ],
            [
                'nombre' => 'María García',
                'telefono' => '677234567',
                'edad' => 22,
                'password' => Hash::make('password123'),
                'email' => 'maria@ejemplo.com',
                'sexo' => 'F',
            ],
             [
                'nombre' => 'Carlos López',
                'telefono' => '688345678',
                'edad' => 21,
                'password' => Hash::make('password123'),
                'email' => 'carlos@ejemplo.com',
                'sexo' => 'M',
            ],
        ]);
    }
}
