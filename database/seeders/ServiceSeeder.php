<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'wtype' => 'pla', 'description' => 'Plastic waste: PET bottle, cosmetic flasks (PP+HDPE), bags.'],
            ['id' => 2, 'wtype' => 'gla', 'description' => 'Glass waste: coloured and white glass.'],
            ['id' => 3, 'wtype' => 'green', 'description' => 'Green waste: compostable garden waste.'],
            ['id' => 4, 'wtype' => 'pap', 'description' => 'Paper waste: newspapers, books, cardboard boxes.'],
            ['id' => 5, 'wtype' => 'com', 'description' => 'Communal waste: solid, residential, non-degradable, non-hazardous waste.'],
        ];

        foreach ($data as $item) {
            Service::create($item);
        }
    }
}
