<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'estado'];

    public function clientes()
    {
        return $this->hasMany(Client::class);
    }

    public function representantes()
    {
        return $this->hasMany(Representante::class);
    }

}
