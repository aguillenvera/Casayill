<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_ingreso',
        'referencia_id',
        'monto',
        'fecha',
    ];
    
    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(VentaProductoClientes::class, 'referencia_id');
    }

    // Relación con Alquiler
    public function alquiler()
    {
        return $this->belongsTo(Alquiler::class, 'referencia_id');
    }
}
