<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Nomina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NominaController extends Controller
{
    public function index(Request $request)
    {
        $nominas = Nomina::with('empleado')->get();

        $empleados = Empleado::all();

        $totalNomina = $nominas->sum('monto');

        return view('nomina.index',compact('nominas', 'empleados', 'totalNomina'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('nomina.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validatePayroll = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'periodo' => 'required|string|max:255',
        ]);

        try {
            Nomina::create($validatePayroll);

            $success = array("message" => "Registro de nomina agregado correctamente", "alert" => "success");

            return redirect()->route('nomina.index')->with('success', $success);
        } catch (\Exception $e) {
            Log::error('Error al registrar el pago de nómina: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error al registrar el pago de nómina: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $nomina = Nomina::findOrFail($id);
        $empleados = Empleado::all();
        return view('nomina.edit', compact('nomina', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $validatePayrroll = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'periodo' => 'required|string|max:255',
        ]);

        $employed = Nomina::findOrFail($id);
        $employed->update($validatePayrroll);

        $success = array("message" => "Registro de nomina actualizado correctamente", "alert" => "success");

        return redirect()->route('nomina.index')->with('success', $success); // Redirect to index page after update
    }

    public function destroy($id)
    {
        $payroll = Nomina::findOrFail($id);
        $payroll->delete();

        $success = array("message" => "Registro de nomina eliminado correctamente", "alert" => "success");

        return to_route('nomina.index')->with('success', $success); // Redirect to index page after delete
    }
}
