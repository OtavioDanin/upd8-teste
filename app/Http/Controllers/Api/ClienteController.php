<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Cliente\ClienteDTO;
use APP\Exceptions\ClientException;
use App\Http\Controllers\Controller;
use App\Interface\ClienteServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Throwable;

class ClienteController extends Controller
{
    public function __construct(protected ClienteServiceInterface $clienteService, protected Logger $logger) {}

    public function index(): JsonResponse
    {
        try {
            $clientes = $this->clienteService->getClientsWithCity();
            $clienteOutput = ClienteDTO::ouputData($clientes);
            return response()->json($clienteOutput, 200);
        } catch (ClientException $cliEx) {
            $this->logger->error($cliEx->getMessage());
            return response()->json(['message' => $cliEx->getMessage(), 'statusCode' => $cliEx->getCode()], $cliEx->getCode());
        } catch (Throwable $th) {
            $this->logger->critical($th->getMessage());
            return response()->json(['message' => 'Ocorreu uma falha inesperada', 'statusCode' => 500], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $inputDataCliente = ClienteDTO::inputData($request->all());
            $this->clienteService->createClient($inputDataCliente);
            return response()->json(['message' => 'Cliente cadastrado com sucesso.', 'statusCode' => 201], 201);
        } catch (ClientException $cliEx) {
            $this->logger->error($cliEx->getMessage());
            return response()->json(['message' => $cliEx->getMessage(), 'statusCode' => $cliEx->getCode()], $cliEx->getCode());
        } catch (Throwable $th) {
            $this->logger->critical($th->getMessage());
            return response()->json(['message' => 'Ocorreu uma falha inesperada', 'statusCode' => 500], 500);
        }
    }

    public function update(Request $request, string $idCliente): JsonResponse
    {
        try {
            $this->clienteService->updateClient($idCliente, $request->all());
            return response()->json(['message' => 'Cliente atualizado com sucesso.', 'statusCode' => 200], 200);
        } catch (ClientException $cliEx) {
            $this->logger->error($cliEx->getMessage());
            return response()->json(['message' => $cliEx->getMessage(), 'statusCode' => $cliEx->getCode()], $cliEx->getCode());
        } catch (ModelNotFoundException $moEx) {
            $this->logger->error($moEx->getMessage());
            return response()->json(['message' => 'Cliente não encontrado para edição', 'statusCode' => 404], 404);
        } catch (Throwable $th) {
            $this->logger->critical($th->getMessage());
            return response()->json(['message' => 'Ocorreu uma falha inesperada', 'statusCode' => 500], 500);
        }
    }

    public function destroy(string $idCliente): JsonResponse
    {
        try {
            $this->clienteService->deleteClient($idCliente);
            return response()->json(['message' => 'Cliente removido com sucesso.', 'statusCode' => 200], 200);
        } catch (ClientException $cliEx) {
            return response()->json(['message' => $cliEx->getMessage(), 'statusCode' => $cliEx->getCode()], $cliEx->getCode());
            $this->logger->error($cliEx->getMessage());
        } catch (ModelNotFoundException $moEx) {
            $this->logger->error($moEx->getMessage());
            return response()->json(['message' => 'Cliente não encontrado para ser deletado', 'statusCode' => 404], 404);
        } catch (Throwable $th) {
            $this->logger->critical($th->getMessage());
            return response()->json(['message' => 'Ocorreu uma falha inesperada', 'statusCode' => 500], 500);
        }
    }
}
