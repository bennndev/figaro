<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Módelo
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Corte de Cabello Clásico',
                'description' => 'Corte tradicional adaptado a tu estilo personal y forma de rostro.',
                'image' => 'images/services/corte_clasico.jpg',
                'duration_minutes' => 30,
                'price' => 15.00,
            ],
            [
                'name' => 'Corte Moderno Fade',
                'description' => 'Corte con degradado profesional y acabado perfecto.',
                'image' => 'images/services/corte_fade.jpg',
                'duration_minutes' => 45,
                'price' => 20.00,
            ],
            [
                'name' => 'Afeitado Tradicional',
                'description' => 'Afeitado con navaja de barbero y toalla caliente relajante.',
                'image' => 'images/services/afeitado_tradicional.jpg',
                'duration_minutes' => 25,
                'price' => 12.00,
            ],
            [
                'name' => 'Arreglo de Barba Premium',
                'description' => 'Perfilado y arreglo de barba con aceites esenciales.',
                'image' => 'images/services/arreglo_barba.jpg',
                'duration_minutes' => 30,
                'price' => 15.00,
            ],
            [
                'name' => 'Corte + Barba Completo',
                'description' => 'Servicio completo de corte de cabello y arreglo de barba.',
                'image' => 'images/services/corte_barba.jpg',
                'duration_minutes' => 60,
                'price' => 25.00,
            ],
            [
                'name' => 'Undercut Profesional',
                'description' => 'Corte undercut con diseño personalizado y acabado premium.',
                'image' => 'images/services/undercut.jpg',
                'duration_minutes' => 40,
                'price' => 22.00,
            ],
            [
                'name' => 'Pompadour Styling',
                'description' => 'Corte estilo pompadour con peinado y fijador de calidad.',
                'image' => 'images/services/pompadour.jpg',
                'duration_minutes' => 50,
                'price' => 28.00,
            ],
            [
                'name' => 'Masaje Capilar',
                'description' => 'Tratamiento relajante del cuero cabelludo con aceites naturales.',
                'image' => 'images/services/masaje_capilar.jpg',
                'duration_minutes' => 20,
                'price' => 10.00,
            ],
            [
                'name' => 'Tratamiento Anti-Caspa',
                'description' => 'Tratamiento especializado para eliminar la caspa y nutrir el cabello.',
                'image' => 'images/services/tratamiento_caspa.jpg',
                'duration_minutes' => 35,
                'price' => 18.00,
            ],
            [
                'name' => 'Corte Infantil',
                'description' => 'Corte especial para niños con técnicas adaptadas y ambiente amigable.',
                'image' => 'images/services/corte_infantil.jpg',
                'duration_minutes' => 25,
                'price' => 12.00,
            ],
            [
                'name' => 'Peinado de Evento',
                'description' => 'Peinado profesional para bodas, graduaciones y eventos especiales.',
                'image' => 'images/services/peinado_evento.jpg',
                'duration_minutes' => 45,
                'price' => 30.00,
            ],
            [
                'name' => 'Limpieza Facial Masculina',
                'description' => 'Tratamiento facial completo con limpieza profunda y hidratación.',
                'image' => 'images/services/limpieza_facial.jpg',
                'duration_minutes' => 40,
                'price' => 25.00,
            ],
            [
                'name' => 'Texturizado Profesional',
                'description' => 'Corte con texturizado avanzado para dar volumen y movimiento.',
                'image' => 'images/services/texturizado.jpg',
                'duration_minutes' => 35,
                'price' => 20.00,
            ],
            [
                'name' => 'Corte Militar',
                'description' => 'Corte de estilo militar preciso y profesional.',
                'image' => 'images/services/corte_militar.jpg',
                'duration_minutes' => 20,
                'price' => 14.00,
            ],
            [
                'name' => 'Servicio VIP Completo',
                'description' => 'Experiencia premium: corte, barba, masaje, bebida y atención personalizada.',
                'image' => 'images/services/servicio_vip.jpg',
                'duration_minutes' => 90,
                'price' => 50.00,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
