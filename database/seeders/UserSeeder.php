<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Enrique',
            'ubicacion' => 'Catastro',
            'status' => 'activo',
            'email' => 'enrique_j_@hotmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Jesus Manriquez Vargas',
            'ubicacion' => 'Catastro',
            'status' => 'activo',
            'email' => 'jsubdirti.irycem@correo.michoacan.gob.mx',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');

    }
}
