<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Cliente;
use App\Models\Divisa;
use App\Models\Ingreso;
use App\Models\Inventario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class AlquilerController extends Controller
{
    public function index()
    {
        $alquileres = Alquiler::with(['cliente', 'producto'])->get();

        foreach ($alquileres as $alquiler) {
            $alquiler->fecha_devolucion = Carbon::parse($alquiler->fecha_alquiler)->addDays(2);
        }

        return view('alquiler.index', compact('alquileres'));
    }
    
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Inventario::where('tipo', 'alquiler')->get();
        $divisas = Divisa::all();
        $tiposDeCambio = $divisas->pluck('tasa', 'name')->toArray();


        return view('alquiler.create', compact('clientes', 'productos','tiposDeCambio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:inventarios,id',
            'fecha_alquiler' => 'required|date',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);

        // Crear  el cliente si no esta registrado
        if ($request->has('cliente_id')) {
            $cliente = Cliente::findOrFail($request->input('cliente_id'));
        }
        elseif (!$request->input('cliente_id')) {
            $cliente = new Cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->apellido = $request->input('apellido');
            $cliente->cedula = $request->input('cedula');
            $cliente->direccion = $request->input('direccion');
            $cliente->correo = $request->input('correo');
            $cliente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $cliente->telefono = $request->input('telefono');
            $cliente->save();      
        }

        $producto = Inventario::find($request->producto_id);

        if ($producto->cantidad < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'La cantidad solicitada excede el stock disponible.']);
        }

        $alquiler = Alquiler::create([
            'cliente_id' => $cliente->id,
            'producto_id' => $request->producto_id,
            'fecha_alquiler' => $request->fecha_alquiler,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        // Registrar el ingreso en ingresos_diarios
        Ingreso::create([
            'tipo_ingreso' => 'alquiler',
            'referencia_id' => $alquiler->id,
            'monto' => $alquiler->precio, // Suponiendo que 'precio' es el campo que contiene el monto del alquiler
            'fecha' => now()->toDateString(),
        ]);

        $producto->decrement('cantidad', $request->cantidad);

        $success = array("message" => "Producto agregado correctamente", "alert" => "success");

        return redirect()->route('alquiler.index')->with('success', $success);
    }

    public function edit($id)
    {
        $alquiler = Alquiler::with(['cliente','producto'])->findOrFail($id);
        $clientes = Cliente::all();
        $divisas = Divisa::all();

        $tiposDeCambio = $divisas->pluck('tasa', 'name')->toArray();

        $productos = Inventario::where('tipo', 'alquiler')->get();

        return view('alquiler.edit', compact('alquiler', 'clientes', 'productos', 'tiposDeCambio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:inventarios,id',
            'fecha_alquiler' => 'required|date',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);

        // Buscar el alquiler existente
        $alquiler = Alquiler::findOrFail($id);
        
        // Obtener el producto relacionado con el alquiler
        $producto = Inventario::find($request->producto_id);

        // Ajustar inventario si la cantidad ha cambiado
        $diferenciaCantidad = $request->cantidad - $alquiler->cantidad;
        
        if ($diferenciaCantidad > 0 && $producto->cantidad < $diferenciaCantidad) {
            return back()->withErrors(['cantidad' => 'La cantidad solicitada excede el stock disponible.']);
        }

        // Actualizar los detalles del alquiler
        $alquiler->update([
            'cliente_id' => $request->cliente_id,
            'producto_id' => $request->producto_id,
            'fecha_alquiler' => $request->fecha_alquiler,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        // Ajustar el inventario según la diferencia de cantidad
        if ($diferenciaCantidad !== 0) {
            $producto->decrement('cantidad', $diferenciaCantidad);
        }

        // Actualizar el ingreso si el precio ha cambiado
        $ingreso = Ingreso::where('tipo_ingreso', 'alquiler')
                        ->where('referencia_id', $alquiler->id)
                        ->first();

        if ($ingreso) {
            $ingreso->update([
                'monto' => $alquiler->precio, // Actualizar al nuevo precio
                'fecha' => now()->toDateString(), // Actualizar la fecha si es necesario
            ]);
        }

        $success = array("message" => "Alquiler actualizado correctamente", "alert" => "success");

        return redirect()->route('alquiler.index')->with('success', $success);
    }


    public function checkOverdueAlquileres()
    {
        // Obtén la fecha actual
        $fechaActual = Carbon::today();

        // Encuentra todos los alquileres que no han sido devueltos
        $alquileresVencidos = Alquiler::where(function ($query) use ($fechaActual) {
            $query->where(function ($subQuery) use ($fechaActual) {
                // Verifica si ha pasado más de 48 horas desde la fecha de alquiler sin extensión
                $subQuery->where('fecha_alquiler', '<', $fechaActual->subRealDays(1))
                        ->where('fecha_extension_alquiler', null);
            })
            ->orWhere(function ($subQuery) use ($fechaActual) {
                // Verifica si ha pasado más de 48 horas desde la fecha de extensión
                $subQuery->where('fecha_extension_alquiler', '<', $fechaActual)
                        ->where('devuelto', false);
            });
        })
        ->where('devuelto', false) // Asegúrate de que el alquiler no ha sido devuelto
        ->get();

        // Crea una colección para almacenar los resultados
        $resultados = [];

        foreach ($alquileresVencidos as $alquiler) {
            // Calcula el costo adicional
            $costoAdicional = $alquiler->precio * 0.5;

            // Calcula días vencidos según la fecha de extensión o fecha de alquiler
            $diasVencidos = $alquiler->fecha_alquiler
                ? $fechaActual->diffInDays($alquiler->fecha_alquiler) 
                : $fechaActual->diffInDays($alquiler->fecha_extension_alquiler);

            // Añade el alquiler a los resultados
            $resultados[] = [
                'cliente' => $alquiler->cliente->nombre,
                'producto' => $alquiler->producto->producto,
                'marca' => $alquiler->producto->marca,
                'precio' => $alquiler->precio,
                'costo_adicional' => $costoAdicional,
                'cantidad' => $alquiler->cantidad,
                'dias_vencidos' => $diasVencidos,
                'es_extension' => $alquiler->fecha_extension_alquiler !== null,
            ];
        }

        // Devuelve los resultados como JSON
        return response()->json($resultados);
    }


    public function marcarComoDevuelto($id)
    {
        $alquiler = Alquiler::findOrFail($id);

        // Verificar si el alquiler ya fue marcado como devuelto
        if ($alquiler->devuelto) {
            return redirect()->back()->with('message', 'Este alquiler ya ha sido devuelto.');
        }

        // Marcar el alquiler como devuelto
        $alquiler->devuelto = true;
        $alquiler->fecha_entrega = now();
        $alquiler->save();

        // Devolver la cantidad de productos al inventario
        $producto = Inventario::findOrFail($alquiler->producto_id);
        $producto->cantidad += $alquiler->cantidad;
        $producto->save();

        // Redirigir a la página anterior con un mensaje de éxito
        $success = array("message" => "Producto agregado correctamente", "alert" => "success");

        return back()->with('success', $success);
    }

    // Método para extender el plazo de un alquiler
    public function extendRental(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_extension_alquiler' => 'required|date|after:fecha_alquiler',
        ]);

        // Buscar el alquiler por su ID
        $alquiler = Alquiler::findOrFail($id);

        // Verificar si el alquiler ya fue marcado como devuelto
        if ($alquiler->devuelto) {
            return redirect()->back()->with('success', 'Este alquiler ya ha sido devuelto y no se puede extender.');
        }

        // Actualizar la fecha de extensión
        $alquiler->fecha_extension_alquiler = $request->fecha_extension_alquiler;

        // Calcular el nuevo precio con un 50% adicional
        $alquiler->precio += ($alquiler->precio * 0.5);
        $alquiler->save();

        // Redirigir a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'Alquiler extendido con éxito. El precio ha sido actualizado.');
    }

    public function destroy($id)
    {
        $alquiler = Alquiler::findOrFail($id);

        $cantidad = $alquiler->cantidad;
        $alquiler->productos->increment('cantidad', $cantidad);

        $alquiler->delete();
        
        $success = array("message" => "Producto eliminado correctamente", "alert" => "success");

        return back()->with('success', $success);
    }

    public function generarRecibo(Alquiler $alquiler)
    {
        // Obtener tasas de cambio desde la base de datos o configuraciones
        $tiposDeCambio = Divisa::whereIn('name', ['USD', 'COP', 'Bs'])->pluck('tasa', 'name');
        
        $tasaPesos = $tiposDeCambio['COP'] ?? 1;
        $tasaBolivares = $tiposDeCambio['Bs'] ?? 1;

        // Calcular el total en dólares
        $totalDolares = $alquiler->precio * $alquiler->cantidad;

        // Calcular conversiones de moneda
        $totalPesos = $totalDolares * $tasaPesos;
        $totalBolivares = $totalDolares * $tasaBolivares;

        $customer = new Buyer([
            'name'          => $alquiler->cliente->nombre.' '.$alquiler->cliente->apellido,
            'custom_fields' => [
                'cedula' => $alquiler->cliente->cedula,
            ],
        ]);

        $seller = new Buyer([
            'name'          => auth()->user()->name,
            'custom_fields' => [
                'cedula' => auth()->user()->email,
            ],
        ]);

        // Crear el ítem de la factura
        $items[] = InvoiceItem::make($alquiler->producto->producto)
                    ->pricePerUnit($alquiler->precio)
                    ->quantity($alquiler->cantidad);

        $alquiler->fecha_devolucion = Carbon::parse($alquiler->fecha_alquiler)->addDays(2)->format('d/m/Y');

        // Añadir información adicional como ítems de la factura o campos personalizados
        $invoice = Invoice::make('Factura de Alquiler')
            ->buyer($customer)
            ->seller($seller)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->taxRate(15)
            ->dateFormat('d/m/Y')
            ->logo('assets/images/iconsIndex/logoYill.bmp')
            ->addItems($items)
            ->setCustomData([
                'fecha_alquiler' => Carbon::parse($alquiler->fecha_alquiler)->format('d/m/Y'),
                'fecha_devolucion' => $alquiler->fecha_devolucion,
                'total_pesos' => $totalPesos,
                'total_bolivares' => $totalBolivares,
            ]);

        return $invoice->stream();
    }
}
