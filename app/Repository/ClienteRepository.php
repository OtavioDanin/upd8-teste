<?php

declare(strict_types=1);

namespace App\Repository;

use App\Interface\ClienteRepositoryInterface;
use App\Models\Cliente;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function __construct(protected Cliente $cliente) {}

    public function getAll(): array
    {
        $clients = $this->cliente::with(['cidade'])->get();
        return $clients->toArray();
    }

    public function persist(array $dataCliente): bool
    {
        $this->cliente->nome = $dataCliente['nome'];
        $this->cliente->cpf = $dataCliente['cpf'];
        $this->cliente->data_nascimento = $dataCliente['data_nascimento'];
        $this->cliente->cidade_id = $dataCliente['cidade_id'];
        return $this->cliente->save($dataCliente);
    }

    public function update(array $dataCliente, $idCliente): bool
    {
        $cliente = $this->cliente::findOrFail($idCliente);
        return $cliente->update($dataCliente);
    }

    public function delete(string $idCliente): bool
    {
        $cliente = $this->cliente::findOrFail($idCliente);
        return $cliente->deleteOrFail();
    }
}
