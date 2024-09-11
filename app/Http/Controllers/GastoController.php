<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
    public function index(Request $request)
    {
        // Obtenemos los parámetros de filtro de fechas
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $gastos = Gasto::query();

        // Filtrar por fechas si se proporcionan
        if ($fechaInicio && $fechaFin) {
            $gastos->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        } elseif ($fechaInicio) {
            $gastos->whereDate('fecha', '>=', $fechaInicio);
        } elseif ($fechaFin) {
            $gastos->whereDate('fecha', '<=', $fechaFin);
        }

        // Obtener los gastos filtrados
        $gastos = $gastos->get();

        // Calcular el balance
        $balance = Gasto::whereBetween('fecha', [$fechaInicio, $fechaFin])->sum('monto_gasto');

        // dd($balance);

        return view('gasto.index', compact('gastos', 'balance'));
    }

    public function create()
    {
        return view('gasto.create');
    }
    
    public function store(Request $request)
    {
        $validateGastos = $request->validate([
            'gasto' => 'string|required',
            'fecha' => 'date|required',
            'monto_gasto' => 'numeric|required|min:1',
        ]);

        Gasto::create($validateGastos);

        $success = array("message" => "Gasto diario agregado correctamente", "alert" => "success");

        return to_route('gasto.index')->with('success', $success);
    }

    public function show($id)
    {
        $gastos = Gasto::findOrFail($id);
        return view('gasto.show', compact('gastos'));
    }

    public function edit($id)
    {
        $gasto = Gasto::findOrFail($id);
        return view('gasto.edit', compact('gasto'));
    }

    public function update(Request $request, $id)
    {
        $validateGastos = $request->validate([
            'gasto' => 'string|required',
            'fecha' => 'date|required',
            'monto_gasto' => 'numeric|required|min:1',
        ]);

        $gasto = Gasto::findOrFail($id);
        $gasto->update($validateGastos);

        $success = array("message" => "Gasto actualizado correctamente", "alert" => "success");

        return back()->with('success', $success);
    }

    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();

        $success = array("message" => "Gasto eleminado exitosamente", "alert" => "success");

        return to_route('gasto.index')->with('success', $success); 
    }
    
}
