<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Ingreso;
use Illuminate\Http\Request;

class CierreController extends Controller
{
    public function index(Request $request)
    {
        // Obtenemos los parámetros de filtro de fechas
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $gastos = Gasto::query();
        $ingresos = Ingreso::query();

        if ($fechaInicio && $fechaFin) {
            $ingresos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
            $gastos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        $ingresos = $ingresos->get();
        $gastos = $gastos->get();

        // Calcular el balance
        $totalIngresos = $ingresos->sum('monto');
        $totalGastos = $gastos->sum('monto_gasto');
        $balance = $totalIngresos - $totalGastos;
        // dd($balance);

        return view('cierre.index', compact('ingresos', 'gastos', 'totalIngresos', 'totalGastos', 'balance', 'fechaInicio', 'fechaFin'));
    }
}
