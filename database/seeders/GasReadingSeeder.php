<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GasReading;

class GasReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['gas_level' => 50.3, 'fire_detected' => false],
            ['gas_level' => 60.7, 'fire_detected' => false],
            ['gas_level' => 45.1, 'fire_detected' => true],
            ['gas_level' => 70.5, 'fire_detected' => false],
            ['gas_level' => 85.2, 'fire_detected' => true],
            ['gas_level' => 30.4, 'fire_detected' => false],
            ['gas_level' => 55.6, 'fire_detected' => true],
            ['gas_level' => 78.9, 'fire_detected' => false],
            ['gas_level' => 90.0, 'fire_detected' => true],
            ['gas_level' => 40.2, 'fire_detected' => false],
        ];

        foreach ($data as $entry) {
            GasReading::create($entry);
        }
    }
}
