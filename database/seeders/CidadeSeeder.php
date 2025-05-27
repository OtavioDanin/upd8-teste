<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = [
            ['nome' => 'Guarulhos', 'estado' => 'SP'],
            ['nome' => 'São Paulo', 'estado' => 'SP'],
            ['nome' => 'Trindade', 'estado' => 'RJ'],
            ['nome' => 'Vilage', 'estado' => 'SC'],
            ['nome' => 'Belém', 'estado' => 'PA'],
            ['nome' => 'Ananindeua', 'estado' => 'PA'],
            ['nome' => 'Belo Horizonte', 'estado' => 'MG'],
            ['nome' => 'Campinas', 'estado' => 'SP'],
            ['nome' => 'Rio de Janeiro', 'estado' => 'RJ'],
            ['nome' => 'Niterói', 'estado' => 'RJ'],
        ];

        foreach ($cidades as $cidade) {
            Cidade::firstOrCreate($cidade);
        }
    }
}
