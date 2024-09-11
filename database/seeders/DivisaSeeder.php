<?php

namespace Database\Seeders;

use App\Models\Divisa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisa = [
            [
                'name' => 'USD',
                'tasa' => 1
            ],
            [
                'name' => 'COP',
                'tasa' => 4000
            ],
            [
                'name' => 'Bs',
                'tasa'=> 36
            ]
        ];
        Divisa::insert($divisa);   
     }
}
