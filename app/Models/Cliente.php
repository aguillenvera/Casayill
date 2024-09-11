<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'fecha_nacimiento',
        'telefono',
        'cedula',
        'correo',
    ];

    use HasFactory;

    public function ventas()
    {
        $this->hasMany(VentaProductoClientes::class);
    }
    public function alquileres()
    {
        $this->hasMany(Alquiler::class);
    }

    // Relación de muchos a muchos con el modelo Inventario a través de la tabla venta_producto_cliente
    public function productos()
    {
        return $this->belongsToMany(Inventario::class, 'venta_producto_clientes')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }
}
