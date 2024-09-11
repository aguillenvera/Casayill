<?php

namespace App\Http\Controllers;

use App\Mail\Ofertas;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfertasController extends Controller
{
    public function index() {
        $clientes =  Cliente::all();
        return view("oferta.index" , compact('clientes'));
    }

    public function send(Request $request){
        $oferta = $request->input('oferta');
        $clientesSeleccionados = $request->input('clientes');
    
        foreach ($clientesSeleccionados as $clienteId) {
            $cliente = Cliente::find($clienteId); 
            $correo = new Ofertas($oferta);
            Mail::to($cliente->correo)->send($correo); 
        }
    
        return back()->with('success', 'Correos electrónicos enviados exitosamente.');
    }
    //
}
