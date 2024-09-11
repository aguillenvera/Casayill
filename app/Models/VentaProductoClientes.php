<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaProductoClientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'productos_id',
        'clientes_id',
        'cantidad',
        'precio',
    ];

    // Relación con los clientes y productos
    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsTo(Inventario::class);
    }
}
