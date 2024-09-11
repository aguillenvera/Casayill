<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
        // Obtenemos los parámetros de filtro de fechas
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $ingresos = Ingreso::query();

        // Filtrar por fechas si se proporcionan
        if ($fechaInicio && $fechaFin) {
            $ingresos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        } elseif ($fechaInicio) {
            $ingresos->whereDate('fecha', '>=', $fechaInicio);
        } elseif ($fechaFin) {
            $ingresos->whereDate('fecha', '<=', $fechaFin);
        }

        // Obtener los ingresos filtrados
        $ingresos = $ingresos->get();
        $balance = Ingreso::whereBetween('fecha', [$fechaInicio, $fechaFin])->sum('monto');

        return view('ingreso.index', compact('ingresos', 'balance'));
    }

    public function show($id)
    {
        $ingresos = Ingreso::findOrFail($id);

        if ($ingresos->tipo_ingreso === 'venta') {
            $detalle = $ingresos->venta;  // Cargar detalles de la venta
        } elseif ($ingresos->tipo_ingreso === 'alquiler') {
            $detalle = $ingresos->alquiler;  // Cargar detalles del alquiler
        }
        
        return view('ingreso.show', compact('ingresos','detalle'));
    }
}
