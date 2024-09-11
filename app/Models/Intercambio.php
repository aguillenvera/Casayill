<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intercambio extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'valor_intercambio', 'producto_intercambiado'];

    public function productos()
    {
        return $this->belongsToMany(Inventario::class, 'intercambio_productos')
                    ->withPivot('cantidad', 'valor_producto')
                    ->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
