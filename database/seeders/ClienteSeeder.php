<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CidadeSeeder::class);

        $guarulhosId = Cidade::where('nome', 'Guarulhos')->first()->id ?? null;
        $saoPauloId = Cidade::where('nome', 'São Paulo')->first()->id ?? null;
        $trindadeId = Cidade::where('nome', 'Trindade')->first()->id ?? null;
        $vilageId = Cidade::where('nome', 'Vilage')->first()->id ?? null;
        $belemId = Cidade::where('nome', 'Belém')->first()->id ?? null;
        $bhId = Cidade::where('nome', 'Belo Horizonte')->first()->id ?? null;
        $campinasId = Cidade::where('nome', 'Campinas')->first()->id ?? null;


        $clientes = [
            [
                'cpf' => '37865865800',
                'nome' => 'Wesley Barbosa',
                'data_nascimento' => '1990-06-06',
                'cidade_id' => $guarulhosId,
            ],
            [
                'cpf' => '32665265400',
                'nome' => 'Ricardo Menezes',
                'data_nascimento' => '1980-06-06',
                'cidade_id' => $saoPauloId,
            ],
            [
                'cpf' => '23532614812',
                'nome' => 'Margaret Hamil',
                'data_nascimento' => '1995-06-06',
                'cidade_id' => $trindadeId,
            ],
            [
                'cpf' => '03232467478',
                'nome' => 'Joan Clarke',
                'data_nascimento' => '2000-06-06',
                'cidade_id' => $vilageId,
            ],
            [
                'cpf' => '87454185002',
                'nome' => 'Luiz Danin',
                'data_nascimento' => '1986-02-07',
                'cidade_id' => $belemId,
            ],
            [
                'cpf' => '87454185001', 
                'nome' => 'Otavio Danin',
                'data_nascimento' => '1998-09-08',
                'cidade_id' => $belemId,
            ],
            [
                'cpf' => '11122233344',
                'nome' => 'Ana Paula',
                'data_nascimento' => '1985-01-10',
                'cidade_id' => $belemId,
            ],
            [
                'cpf' => '55566677788',
                'nome' => 'Carlos Eduardo',
                'data_nascimento' => '1992-03-05',
                'cidade_id' => $bhId,
            ],
            [
                'cpf' => '99988877766',
                'nome' => 'Fernanda Lima',
                'data_nascimento' => '1978-11-12',
                'cidade_id' => $campinasId,
            ],
        ];

        foreach ($clientes as $cliente) {
            if ($cliente['cidade_id']) {
                Cliente::firstOrCreate(['cpf' => $cliente['cpf']], $cliente);
            }
        }
    }
}
