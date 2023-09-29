<?php

namespace App\Http\Controllers;

use App\Repo\FacturaRepo;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function __construct(public FacturaRepo $facturaRepo) {
    }
    public function listar()
    {
        $facturas=$this->facturaRepo->listar();
        return view('factura.listar',['facturas'=>$facturas]);
    }
}
