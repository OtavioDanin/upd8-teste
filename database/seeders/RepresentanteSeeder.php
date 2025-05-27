<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Representante;
use App\Models\Cidade;

class RepresentanteSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CidadeSeeder::class);

        $saoPauloId = Cidade::where('nome', 'São Paulo')->first()->id ?? null;
        $belemId = Cidade::where('nome', 'Belém')->first()->id ?? null;

        $representantes = [
            [
                'nome' => 'João Silva',
                'cargo' => 'Gerente de Vendas',
                'data_nascimento' => '1985-01-15',
                'cidade_id' => $saoPauloId,
            ],
            [
                'nome' => 'Maria Oliveira',
                'cargo' => 'Consultora Comercial',
                'data_nascimento' => '1992-03-20',
                'cidade_id' => $belemId,
            ],
            // Adicione mais representantes conforme necessário
        ];

        foreach ($representantes as $representante) {
            if ($representante['cidade_id']) {
                Representante::firstOrCreate(['nome' => $representante['nome'], 'cidade_id' => $representante['cidade_id']], $representante);
            }
        }
    }
}