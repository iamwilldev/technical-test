<?php

namespace Database\Seeders;

use App\Models\BrandRecomendation;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BrandRecomendation::factory()->count(1)->create();
    }
}
