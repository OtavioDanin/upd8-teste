<?php

namespace App\Http\Middleware;

use APP\Exceptions\ClientException;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ClienteValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $data = $request->all();
            $this->validateData($data);
        } catch (Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'statusCode' => $th->getCode()], $th->getCode());
        }
        return $next($request);
    }

    private function validateData(array $data): void
    {
        if (empty($data)) {
            throw new Exception('Dados vazios enviados', 422);
        }
        if(empty($data['nome'])) {
            throw new Exception('Campo "nome" não pode ser vazio', 422);
        }
        if(empty($data['cpf'])) {
            throw new Exception('Campo "CPF" pode ser vazio', 422);
        }
        if(empty($data['data'])) {
            throw new Exception('Campo "data" do cliente não pode ser vazio', 422);
        }
        if(empty($data['cidade']) || !is_int($data['cidade'])) {
            throw new Exception("Campo 'cidade' do cliente não pode ser vazio e precisa ser um inteiro", 422);
        }
    }
}
