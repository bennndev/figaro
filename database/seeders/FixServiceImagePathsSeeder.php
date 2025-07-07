<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class FixServiceImagePathsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->get()->each(function ($service) {
            if ($service->image && str_starts_with($service->image, 'images/services/')) {
                $service->image = 'services/images/' . basename($service->image);
                $service->save();
            }
        });
    }
}
