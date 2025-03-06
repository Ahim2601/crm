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
        $dev = User::factory()->create([
            'name' => 'Desarrollador',
            'email' => 'rosanyelismendoza@gmail.com',
            'password' => Hash::make('admin'),
        ]); 
        $dev->assignRole('Administrador');
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'ciroclimachile@gmail.com',
            'password' => Hash::make('admin'),
        ]);  
        $admin->assignRole('Administrador');
    }
}
