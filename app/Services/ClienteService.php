<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ClientException;
use App\Interface\ClienteRepositoryInterface;
use App\Interface\ClienteServiceInterface;

class ClienteService implements ClienteServiceInterface
{
    public function __construct(protected ClienteRepositoryInterface $clienteRepository) {}

    public function getClientsWithCity(): array
    {
        $clientsArray = $this->clienteRepository->getAll();
        if (empty($clientsArray)) {
            throw new ClientException('Não há clientes cadastrados', 404);
        }
        return $clientsArray;
    }

    public function createClient(array $dataCliente): void
    {
        $hasSave = $this->clienteRepository->persist($dataCliente);
        if (!$hasSave) {
            throw new ClientException('Falha em realizar o cadastrado', 503);
        }
    }

    public function updateClient(string $idCliente, array $dados): void
    {
        if (!ctype_digit(trim($idCliente))) {
            throw new ClientException('Id do cliente precisa ser um valor inteiro', 400);
        }
        if (empty($dados)) {
            throw new ClientException('Dados vazio no corpo da requisição', 400);
        }
        $hasEdit = $this->clienteRepository->update($dados, $idCliente);
        if (!$hasEdit) {
            throw new ClientException('Falha em realizar a edição', 503);
        }
    }

    public function deleteClient(string $idCliente): void
    {
        if (!ctype_digit(trim($idCliente))) {
            throw new ClientException('Id do cliente precisa ser um valor inteiro', 400);
        }
        $hasDelete = $this->clienteRepository->delete($idCliente);
        if (!$hasDelete) {
            throw new ClientException('Falha em remoção a edição', 503);
        }
    }
}
