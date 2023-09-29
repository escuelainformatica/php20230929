<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::controller(ClienteController::class)->prefix('cliente')->group(function() {
    Route::get("/",'listar');
});
Route::controller(FacturaController::class)->prefix('factura')->group(function() {
    Route::get("/",'listar');
});    
