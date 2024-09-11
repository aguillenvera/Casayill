<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $clientes =   Cliente::all();
      return view('cliente.index', compact('clientes'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateClient = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'cedula' => 'required|numeric',
            'fecha_nacimiento' => 'required',
            'correo' => 'required'

        ]);
       
        Cliente::create($validateClient);

        $success = array("message" => "Cliente registrado Satisfactoriamente", "alert" => "success");
        return redirect()->route('cliente.index')->with('success',$success);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'direccion' => 'required|string',
            'fecha_nacimiento' => 'required',
            'telefono' => 'required|string',
            'cedula' => 'required|numeric',
            'correo'=> 'required'
        ]);

        $updated = Cliente::where("id", $cliente->id);
        $updated->update([
            'nombre' => $request->input("nombre"),
            'apellido' => $request->input("apellido"),
            'fecha_nacimiento' => $request->input("fecha_nacimiento"),
            'direccion' => $request->input("direccion"),
            'telefono' => $request->input("telefono"),
            'cedula' => $request->input("cedula"),
            'correo' => $request->input("correo")
        ]);
        $success = array("message" => "Cliente editado Satisfactoriamente", "alert" => "success");
        return redirect()->route('cliente.index')->with('success',$success);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('cliente.index')->with('success','Cliente Eliminado.');
    }
}
