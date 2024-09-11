<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LibroDiario;

class Fecha extends Model
{
    use HasFactory;

    protected $table = 'fechas';

    protected $fillable = ['fecha'];

    // public function libro() {
    //     return $this->hasMany(LibroDiario::class);
    // }

}
