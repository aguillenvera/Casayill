<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'monto',
        'fecha_deuda',
        'fecha_pago',
        'estado',
        'descripcion'
    ];
}
