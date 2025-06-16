<?php

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://api.thedogapi.com/v1/breeds');

        if ($response->successful()) {
            $razas = $response->json();

            foreach ($razas as $raza) {
                Breed::updateOrCreate(
                    ['api_id' => $raza['id']],
                    [
                        'name' => $raza['name'],
                        'temperament' => $raza['temperament'] ?? null,
                        'origin' => $raza['origin'] ?? null,
                        'bred_for' => $raza['bred_for'] ?? null,
                        'breed_group' => $raza['breed_group'] ?? null,
                        'life_span' => $raza['life_span'] ?? null,
                        'weight_imperial' => $raza['weight']['imperial'] ?? null,
                        'weight_metric' => $raza['weight']['metric'] ?? null,
                        'height_imperial' => $raza['height']['imperial'] ?? null,
                        'height_metric' => $raza['height']['metric'] ?? null,
                        'reference_image_id' => $raza['reference_image_id'] ?? null,
                    ]
                );
            }

            $this->command->info(count($razas) . ' razas importadas correctamente.');
        } else {
            $this->command->error('No se pudo obtener la información desde TheDogAPI.');
        }
    }
}
