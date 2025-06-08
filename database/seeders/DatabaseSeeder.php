<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        #Seeders
        $this->call(AdminSeeder::class);
        $this->call(SpecialtySeeder::class);
        
        #Factories
        User::factory(10)->create();
    }
}
