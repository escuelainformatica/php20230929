<?php
namespace App\Repo;
use App\Models\Cliente;

class ClienteRepo {

    public function listar()
    {
        return Cliente::all();
    }
}
