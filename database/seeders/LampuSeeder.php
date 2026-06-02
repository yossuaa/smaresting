<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lampu;

class LampuSeeder extends Seeder
{
    public function run(): void
    {
        Lampu::updateOrCreate(
            ['id' => 1],
            ['nama_lampu' => 'Titik Lampu 1']
        );

        Lampu::updateOrCreate(
            ['id' => 2],
            ['nama_lampu' => 'Titik Lampu 2']
        );

        Lampu::updateOrCreate(
            ['id' => 3],
            ['nama_lampu' => 'Titik Lampu 3']
        );

        Lampu::updateOrCreate(
            ['id' => 4],
            ['nama_lampu' => 'Titik Lampu 4']
        );
    }
}
