<?php

namespace Database\Seeders;

use App\Models\Cartao;
use Illuminate\Database\Seeder;

class CartaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cartao::factory(5)->create([
            'numero_cartao' => function () {
                $numero_cartao = '****-****-****-' . substr(str_shuffle('0123456789'), 0, 4);
                return $numero_cartao;
            },
        ]);
    }
}
