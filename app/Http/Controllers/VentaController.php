<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Divisa;
use App\Models\Ingreso;
use App\Models\Inventario;
use App\Models\VentaProductoClientes;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = VentaProductoClientes::with(['clientes', 'productos'])->get();
        $divisas = Divisa::all();
        return view('venta.index', compact('ventas', 'divisas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Inventario::where('tipo', 'venta')->get();
        $divisas = Divisa::all();
        $tiposDeCambio = $divisas->pluck('tasa', 'name')->toArray();


        return view('venta.create', compact('clientes', 'productos', 'divisas','tiposDeCambio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clientes_id' => 'nullable|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:inventarios,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'descuento' => 'nullable|numeric|min:0|max:100',
        ]);

        // Crear o buscar el cliente
        if ($request->input('cliente_id')) {
            $cliente = Cliente::findOrFail($request->input('cliente_id'));
        } else {
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

        $totalPrecio = 0;
        $descuento = $request->input('descuento', 0); // Obtener el descuento, por defecto 0 si no se proporciona

        foreach ($request->productos as $producto) {
            $cantidad = $producto['cantidad'];
            $productoModel = Inventario::find($producto['producto_id']);

            if ($productoModel->cantidad < $cantidad) {
                return back()->withErrors(['productos' => 'La cantidad solicitada excede el stock disponible.']);
            }

            // Precio sin descuento
            $precioProducto = $productoModel->precio * $cantidad;

            // Aplicar el descuento al precio del producto
            $precioConDescuento = $precioProducto - ($precioProducto * ($descuento / 100));
            $totalPrecio += $precioConDescuento;

            // Registrar la venta con el precio con descuento
            $venta = VentaProductoClientes::create([
                'clientes_id' => $cliente->id,
                'productos_id' => $productoModel->id,
                'cantidad' => $cantidad,
                'precio' => $precioConDescuento // Guardar el precio con descuento
            ]);

            // Descontar la cantidad del inventario
            $productoModel->decrement('cantidad', $cantidad);
        }

        // Registrar el ingreso en ingresos_diarios con el total con descuento
        Ingreso::create([
            'tipo_ingreso' => 'venta',
            'referencia_id' => $venta->id,
            'monto' => $totalPrecio, // Monto con el descuento aplicado
            'fecha' => now()->toDateString(),
        ]);

        $success = array("message" => "Venta registrada correctamente", "alert" => "success");
        return redirect()->route('venta.index')->with('success', $success);
    }

    public function edit($id)
    {
        // Obtener la venta por ID
        $venta = VentaProductoClientes::with(['clientes', 'productos'])->findOrFail($id);
        $clientes = Cliente::all();
        $productos = Inventario::where('tipo', 'venta')->get();
        $divisas = Divisa::all();
        $tiposDeCambio = $divisas->pluck('tasa', 'name')->toArray();

        return view('venta.edit', compact('venta', 'clientes', 'productos', 'divisas', 'tiposDeCambio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'clientes_id' => 'nullable|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:inventarios,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'descuento' => 'nullable|numeric|min:0|max:100',
        ]);

        // Obtener la venta actual
        $venta = VentaProductoClientes::findOrFail($id);

        
        $productoModelAnterior = Inventario::find($venta->productos_id);
        $productoModelAnterior->increment('cantidad', $venta->cantidad); // Devolver al inventario la cantidad anterior

        // Obtener los nuevos productos y actualizar el inventario
        $totalPrecio = 0;
        $descuento = $request->input('descuento', 0); // Descuento por defecto 0

        foreach ($request->productos as $productoData) {
            $productoModelNuevo = Inventario::find($productoData['producto_id']);
            $cantidad = $productoData['cantidad'];

            // Validar que la cantidad solicitada no exceda el stock disponible
            if ($productoModelNuevo->cantidad < $cantidad) {
                return back()->withErrors(['productos' => 'La cantidad solicitada excede el stock disponible.']);
            }

            // Calcular el precio total para este producto
            $precioProducto = $productoModelNuevo->precio * $cantidad;

            // Aplicar el descuento
            $precioConDescuento = $precioProducto - ($precioProducto * ($descuento / 100));
            $totalPrecio += $precioConDescuento;

            // Actualizar la venta con el nuevo producto y sus detalles
            $venta->productos_id = $productoModelNuevo->id;
            $venta->cantidad = $cantidad;
            $venta->precio = $precioConDescuento; // Guardar el precio con descuento
            $venta->clientes_id = $request->cliente_id; // Asociar el cliente a la venta
            $venta->save();

            // Descontar la cantidad del inventario del nuevo producto
            $productoModelNuevo->decrement('cantidad', $cantidad);
        }

        // Actualizar el total de la venta
        $venta->precio = $totalPrecio;
        $venta->save();

        // Actualizar el ingreso en ingresos_diarios con el total actualizado
        $ingreso = Ingreso::where('referencia_id', $venta->id)->first();
        if ($ingreso) {
            $ingreso->monto = $totalPrecio; // Actualizar el monto del ingreso
            $ingreso->fecha = now()->toDateString();
            $ingreso->save();
        }

        $success = array("message" => "Venta actualizada correctamente", "alert" => "success");
        return redirect()->route('venta.index')->with('success', $success);
    }

    public function destroy($id) // Eliminar venta
    {
        $venta = VentaProductoClientes::findOrFail($id);

        $cantidad = $venta->cantidad; //obtener la cantidad de la venta
        $venta->productos->increment('cantidad', $cantidad); // devolverla al producto 

        $venta->delete();

        $success = array("message" => "Venta eliminada correctamente", "alert" => "success");
        return to_route('venta.index')->with('success', $success);
    }

    public function generarRecibo(VentaProductoClientes $ventaProductoClientes)
    {
        // Obtener tasas de cambio desde la base de datos o configuraciones
        $tiposDeCambio = Divisa::whereIn('name', ['USD', 'COP', 'Bs'])->pluck('tasa', 'name');
        
        $tasaPesos = $tiposDeCambio['COP'] ?? 1;
        $tasaBolivares = $tiposDeCambio['Bs'] ?? 1;

        // Calcular el total en dólares
        $totalDolares = $ventaProductoClientes->productos->precio * $ventaProductoClientes->cantidad;

        // Calcular conversiones de moneda
        $totalPesos = $totalDolares * $tasaPesos;
        $totalBolivares = $totalDolares * $tasaBolivares;

        //agregar estos campos como notas
        $notes = [
            "",
            'Total en COP '. $totalPesos,
            'Total en Bs '. $totalBolivares
        ];
        
        $notes = implode(" <br> " , $notes);


        $customer = new Buyer([
            'name'          => $ventaProductoClientes->clientes->nombre,
            'custom_fields' => [
                'cedula' => $ventaProductoClientes->clientes->cedula,
            ],
        ]);

        $seller = new Buyer([
            'name'          => auth()->user()->name,
            'custom_fields' => [
                'cedula' => auth()->user()->email,
            ],
        ]);

        // Crear el ítem de la factura
        $items[] = InvoiceItem::make($ventaProductoClientes->productos->producto)
                    ->pricePerUnit($ventaProductoClientes->precio)
                    ->quantity($ventaProductoClientes->cantidad);

        // Añadir información adicional como ítems de la factura o campos personalizados
        $invoice = Invoice::make('Factura de Venta')
            ->buyer($customer)
            ->seller($seller)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->taxRate(15)
            ->dateFormat('d/m/Y')
            ->logo('assets/images/iconsIndex/logoYill.bmp')
            ->addItems($items)
            ->notes($notes);

        return $invoice->stream();
    }

}
