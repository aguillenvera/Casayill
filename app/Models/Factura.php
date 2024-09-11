<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    protected $table = 'facturas';

    protected $fillable = ['name', 'direccion', 'Telefono', 'RIF', 'control', 'subtotal', 'factura', 'divisa', 'products', 'tasa_dia'];

    use HasFactory;
}
