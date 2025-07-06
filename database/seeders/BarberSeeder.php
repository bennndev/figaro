<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Carlos',
                'last_name' => 'Martínez',
                'email' => 'carlos.martinez@barberia.com',
                'phone_number' => '+34612345001',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Especialista en cortes modernos y barbas clásicas con más de 10 años de experiencia.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Miguel',
                'last_name' => 'García',
                'email' => 'miguel.garcia@barberia.com',
                'phone_number' => '+34612345002',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Experto en técnicas de afeitado tradicional y cortes de temporada.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Antonio',
                'last_name' => 'López',
                'email' => 'antonio.lopez@barberia.com',
                'phone_number' => '+34612345003',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero con enfoque en estilos urbanos y cortes creativos.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Francisco',
                'last_name' => 'Rodríguez',
                'email' => 'francisco.rodriguez@barberia.com',
                'phone_number' => '+34612345004',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Especializado en cortes clásicos y cuidado de barba premium.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'José',
                'last_name' => 'Fernández',
                'email' => 'jose.fernandez@barberia.com',
                'phone_number' => '+34612345005',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero joven con técnicas innovadoras y estilos contemporáneos.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Juan',
                'last_name' => 'Sánchez',
                'email' => 'juan.sanchez@barberia.com',
                'phone_number' => '+34612345006',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Veterano barbero con más de 15 años perfeccionando su arte.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Manuel',
                'last_name' => 'Jiménez',
                'email' => 'manuel.jimenez@barberia.com',
                'phone_number' => '+34612345007',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Especialista en barbería clásica y técnicas de relajación.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David',
                'last_name' => 'Ruiz',
                'email' => 'david.ruiz@barberia.com',
                'phone_number' => '+34612345008',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero con formación internacional y técnicas vanguardistas.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Daniel',
                'last_name' => 'Moreno',
                'email' => 'daniel.moreno@barberia.com',
                'phone_number' => '+34612345009',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Experto en cortes de cabello masculino y diseño de barbas.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Javier',
                'last_name' => 'Álvarez',
                'email' => 'javier.alvarez@barberia.com',
                'phone_number' => '+34612345010',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero especializado en servicios de lujo y atención personalizada.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Alejandro',
                'last_name' => 'Gómez',
                'email' => 'alejandro.gomez@barberia.com',
                'phone_number' => '+34612345011',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Profesional con enfoque en tendencias actuales y estilos modernos.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rafael',
                'last_name' => 'Díaz',
                'email' => 'rafael.diaz@barberia.com',
                'phone_number' => '+34612345012',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero con experiencia en competencias y certificaciones internacionales.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Pablo',
                'last_name' => 'Castro',
                'email' => 'pablo.castro@barberia.com',
                'phone_number' => '+34612345013',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Especialista en cortes fade y técnicas de degradado precision.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sergio',
                'last_name' => 'Vargas',
                'email' => 'sergio.vargas@barberia.com',
                'phone_number' => '+34612345014',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Barbero con formación en técnicas de spa y tratamientos capilares.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Roberto',
                'last_name' => 'Herrera',
                'email' => 'roberto.herrera@barberia.com',
                'phone_number' => '+34612345015',
                'password' => Hash::make('password123'),
                'profile_photo' => 'images/barber/default-profile.jpg',
                'description' => 'Veterano barbero especializado en cortes tradicionales y barbas de época.',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}
