<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use App\Models\Inventario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class IntercambioController extends Controller
{
    public function index()
    {
        $intercambios = Intercambio::with('cliente', 'productos')->get();

        return view('intercambio.index', compact('intercambios'));
    }

    public function create()
    {
        $productos = Inventario::where('tipo', 'venta')->get();
        $clientes = Cliente::all();
        return view('intercambio.create', compact('productos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_intercambiado' => 'required|string',
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:inventarios,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $cliente = Cliente::find($request->cliente_id);
        $totalValorIntercambio = 0;

        // Crear el intercambio
        $intercambio = Intercambio::create([
            'cliente_id' => $cliente->id,
            'valor_intercambio' => 0, // Inicialmente 0, actualizaremos después
            'producto_intercambiado' => $request->producto_intercambiado 
        ]);

        // Añadir productos al intercambio
        foreach ($request->productos as $productoData) {
            $producto = Inventario::findOrFail($productoData['id']);
            $cantidad = $productoData['cantidad'];
            $valorProducto = $producto->precio * $cantidad;

            // Comprobar si hay suficiente cantidad en inventario
            if ($producto->cantidad < $cantidad) {
                return back()->withErrors(['cantidad' => "La cantidad solicitada de {$producto->nombre} excede el stock disponible."]);
            }

            // Añadir producto al intercambio
            $intercambio->productos()->attach($producto->id, [
                'cantidad' => $cantidad,
                'valor_producto' => $valorProducto
            ]);

            // Restar del inventario
            $producto->decrement('cantidad', $cantidad);

            // Sumar al valor total del intercambio
            $totalValorIntercambio += $valorProducto;
        }

        // Actualizar el valor total del intercambio
        $intercambio->update(['valor_intercambio' => $totalValorIntercambio]);

        return redirect()->route('intercambio.index')->with('success', 'Intercambio registrado con éxito.');
    }

    public function edit($id)
    {
        $intercambio = Intercambio::with('productos')->findOrFail($id);
        $productos = Inventario::all();
        $clientes = Cliente::all();
        
        return view('intercambio.edit', compact('intercambio', 'productos', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:inventarios,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $intercambio = Intercambio::findOrFail($id);

        // Revertir el inventario antes de actualizar
        foreach ($intercambio->productos as $producto) {
            $producto->increment('cantidad', $producto->pivot->cantidad);
        }

        $intercambio->productos()->detach();

        $totalValorIntercambio = 0;

        foreach ($request->productos as $productoData) {
            $producto = Inventario::find($productoData['id']);
            $cantidad = $productoData['cantidad'];
            $valorProducto = $producto->precio * $cantidad;

            if ($producto->cantidad < $cantidad) {
                return back()->withErrors(['cantidad' => "La cantidad solicitada de {$producto->producto} excede el stock disponible."]);
            }

            $intercambio->productos()->attach($producto->id, [
                'cantidad' => $cantidad,
                'valor_producto' => $valorProducto
            ]);

            $producto->decrement('cantidad', $cantidad);

            $totalValorIntercambio += $valorProducto;
        }

        $intercambio->update([
            'cliente_id' => $request->cliente_id,
            'valor_intercambio' => $totalValorIntercambio
        ]);

        return redirect()->route('intercambios.index')->with('success', 'Intercambio actualizado con éxito.');
    }

    public function destroy($id)
    {
        $intercambio = Intercambio::findOrFail($id);

        // Revertir inventario antes de eliminar el intercambio
        foreach ($intercambio->productos as $producto) {
            $producto->increment('cantidad', $producto->pivot->cantidad);
        }

        $intercambio->delete();

        return redirect()->route('intercambio.index')->with('success', 'Intercambio eliminado y productos devueltos al inventario con éxito.');
    }

}
