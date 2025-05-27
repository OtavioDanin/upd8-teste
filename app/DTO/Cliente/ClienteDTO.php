<?php

declare(strict_types=1);

namespace App\DTO\Cliente;

readonly class ClienteDTO
{
    public static function ouputData(array $dataCliente): array
    {
        $map = array_map(function ($data) {
            $cidade = ['id' => $data['cidade']['id'], 'nome' => $data['cidade']['nome'], 'estado' => $data['cidade']['estado']];
            return ['id' => $data['id'], 'nome' => $data['nome'], 'cpf' => $data['cpf'], 'cidade' => $cidade];
        }, $dataCliente);
        return $map;
    }

    public static function inputData(array $dataCliente): array
    {
        return [
            'nome' => $dataCliente['nome'],
            'cpf' => $dataCliente['cpf'],
            'data_nascimento' => $dataCliente['data'],
            'cidade_id' => $dataCliente['cidade']
        ];
    }
}
