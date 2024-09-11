<?php

namespace App\Http\Controllers;

use App\Models\Divisa;
use Illuminate\Http\Request;

class DivisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisas = Divisa::all();
        return view('divisa.index', compact('divisas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisa $divisa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisa $divisa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'tasa' => 'required|numeric'
        ]);
    
        // Cambié find()->get() por find() para obtener un solo modelo
        $divisa = Divisa::find($id);
    
        // Verifica si la divisa fue encontrada
        if ($divisa) {
            $divisa->tasa = $request->input('tasa');
            $divisa->update();
    
            return redirect()->route('divisas.create')->with('success', 'Divisa actualizada satisfactoriamente');
        } else {
            return redirect()->route('divisas.create')->with('error', 'Divisa no encontrada');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisa $divisa)
    {
        //
    }
}
