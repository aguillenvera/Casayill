<?php

namespace App\Exports;

use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlquiladoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventario::where('disponibilidad', 0)
        ->select('codigo', 'Producto', 'Marca', 'Precio', 'Talla', 'Tipo', 'Color', 'almacen')
        ->get();
    
    }
    public function headings(): array
    {
        return [
            'Codigo', 'Producto', 'Marca', 'Precio', 'Talla', 'Tipo', 'Color', 'almacen'
        ];
    }
}
