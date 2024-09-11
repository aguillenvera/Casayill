<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'cedula', 'cargo', 'salario'];

    // Relación uno a muchos con el modelo Nomina
    public function nomina()
    {
        return $this->hasMany(Nomina::class);
    }
}
