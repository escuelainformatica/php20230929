<?php

namespace App\Http\Controllers;

use App\Repo\ClienteRepo;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(public ClienteRepo $clienteRepo) {
    }
    public function listar()
    {
        $clientes=$this->clienteRepo->listar();
        return view('cliente.listar',['clientes'=>$clientes]);
    }
}
