<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Módelo
use App\Models\Admin;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        Admin::create([
            'name' => 'Benjamin',
            'last_name' => 'Sullca',
            'email' => 'benjamin.sullca1103@gmail.com',
            'password' => bcrypt('Tecsup2025')
        ]);
        Admin::create([
            'name' => 'Ander',
            'last_name' => 'Bustamante',
            'email' => 'anderbstz@gmail.com',
            'password' => bcrypt('Tecsup2025')
        ]);
    }
}
