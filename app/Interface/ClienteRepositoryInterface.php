<?php

declare(strict_types=1);

namespace App\Interface;

use App\Models\Cliente;

interface ClienteRepositoryInterface
{
    public function getAll(): array;
    public function persist(array $dataCliente): bool;
    public function update(array $dataCliente, string $id): bool;
    public function delete(string $id): bool;
}