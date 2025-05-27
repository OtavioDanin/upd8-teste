<?php

declare(strict_types=1);

namespace App\Interface;

interface ClienteServiceInterface
{
    public function getClientsWithCity(): array;
    public function createClient(array $dataCliente): void;
    public function updateClient(string $id, array $dados): void;
    public function deleteClient(string $id): void;
}
