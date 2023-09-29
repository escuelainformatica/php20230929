<?php
namespace App\Repo;
use App\Models\Factura;

class FacturaRepo {
    public function listar()
    {
        return Factura::with('cliente')->get();
    }
}
