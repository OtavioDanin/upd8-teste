<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function getCidades()
    {
        $cidades = Cidade::all(['nome']);
        return response()->json($cidades);
    }

    public function getEstados()
    {
        $estados = Cidade::all(['id', 'estado']);
        return response()->json($estados);
    }
}
