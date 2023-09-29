<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $table="facturas";
    public $fillable=['fecha,idcliente'];

    public function cliente() {
        return $this->belongsTo(Cliente::class,'idcliente','id');
     }
    public $timestamps =false;
}
