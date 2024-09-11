<?php

namespace App\Http\Controllers;

use App\Models\Contabilidad;
use Illuminate\Http\Request;

class ContabilidadController extends Controller
{
    public function index()
    {
        $contabilidades = Contabilidad::all();

        return view('contabilidad.index', compact('contabilidades'));
    }

    public function create()
    {
        return view('contabilidad.create');
    }

    public function store(Request $request)
    {
        $validateContability = $request->validate([
            'nombre' => 'string|required',
            'monto' => 'numeric|min:1|required',
            'fecha_deuda' => 'required|date',
            'fecha_pago' => 'nullable|date',
            'estado' => 'string|required',
            'descripcion' => 'string|required'
        ]);

        Contabilidad::create($validateContability);

        $success = array("message" => "Registro de contabilidad agregado correctamente", "alert" => "success");

        return to_route('contabilidad.index')->with('success', $success);
    }

    public function edit($id)
    {
        $contabilidad = Contabilidad::findOrFail($id);

        return view('contabilidad.edit', compact('contabilidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'string|required',
            'monto' => 'numeric|min:1|required',
            'fecha_deuda' => 'required|date',
            'fecha_pago' => 'nullable|date',
            'estado' => 'string|required',
            'descripcion' => 'string|required'
        ]);

        $contabilidad = Contabilidad::findOrFail($id);

        $contabilidad->update();

        $success = array("message" => "Registro de contabilidad actualizado correctamente", "alert" => "success");

        return to_route('contabilidad.index')->with('success', $success);
    }

    public function destroy($id)
    {
        $contabilidad = Contabilidad::findOrFail($id);

        $contabilidad->delete();

        $success = array("message" => "Registro de contabilidad eliminado correctamente", "alert" => "success");

        return back()->with('success', $success);
    }
    
    public function checkPendingDebts()
    {
        $deudasPendientes = Contabilidad::where('estado', 'pendiente')->get();

        return response()->json($deudasPendientes);
    }


    public function cancelarDeuda($id)
    {
        $contabilidad = Contabilidad::findOrFail($id);

        // Actualizar el estado de la deuda a 'cancelada'
        $contabilidad->update(['estado' => 'pagada', 'fecha_pago' => now()]);

        $success = array("message" => "La deuda ha sido cancelada con éxito", "alert" => "success");

        return redirect()->route('contabilidad.index')->with('success', $success);
    }
}
