<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{    

    protected $fillable = [
        'codigo', 'producto', 'marca', 'precio', 'talla','almacen', 'tipo', 'color', 'cantidad'
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
   
   public function clientes()
   {
       return $this->belongsToMany(Cliente::class, 'venta_producto_clientes')
                   ->withPivot('cantidad', 'precio')
                   ->withTimestamps();
   }

   public function clientesA()
   {
       return $this->belongsToMany(Cliente::class, 'alquilers')
                   ->withPivot('cantidad', 'precio')
                   ->withTimestamps();
   }

   public function intercambios()
{
    return $this->belongsToMany(Intercambio::class, 'intercambio_inventario', 'inventario_id', 'intercambio_id')
                ->withPivot('cantidad', 'valor_producto')
                ->withTimestamps();
}


}
