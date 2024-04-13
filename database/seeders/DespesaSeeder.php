<?php

namespace Database\Seeders;

use App\Models\Despesa;
use Illuminate\Database\Seeder;

class DespesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Despesa::factory()->count(5)->create();
    }
}
