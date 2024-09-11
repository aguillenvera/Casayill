<?php

namespace App\Imports;

use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class InventarioImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
 
        if($row['disponibilidad'] === 0 ){
            $alquilado = $row['alquiler'];
        }
        else{
            $alquilado = null;
        }
        if($row['disponibilidad'] == "disponible"){
            $disponibilidad = 1;
        }elseif($row['disponibilidad'] == "alquilado"){
            $disponibilidad = 0;

        }else {
            $disponibilidad = $row['disponibilidad'];
        }
        $producto = new Inventario;
        $producto->producto = $row['producto'];
        $producto->precio = $row['precio'];
        $producto->marca = $row['marca'];
        $producto->tipo = $row['tipo'];
        $producto->talla = $row['talla'];
        $producto->color = $row['color'];
        $producto->almacen = $row['almacen'];
        $producto->disponibilidad = $disponibilidad;
        $producto->alquiler = $alquilado;
        $producto->save();
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
