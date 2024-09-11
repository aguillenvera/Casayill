<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Divisa;
use App\Models\Factura;
use App\Models\Inventario;
use App\Models\LibroDiario;
use App\Models\Fecha;
use Illuminate\Support\Carbon;
use App\Models\ordenEntrega;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;


class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas =  Factura::all();
        $divisa = Divisa::all();
        return view('factura.index', compact('facturas', 'divisa'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */   
     public function create($id)
    {
        $orden = ordenEntrega::find($id);
        $divisa = Divisa::all();

        return view("factura.create", compact('orden', 'divisa'));
    }
    public function new()
    {
        $divisa = Divisa::all();
        $clientes = Cliente::all();
        $products = Inventario::where("cantidad", 1)->get();
        return view("factura.new", compact('clientes', 'products', 'divisa'));
    }
    public function storeNew(Request $request) {
        
        $success = array("message" => "Factura creada Satisfactoriamente", "alert" => "success");

        $request->validate([
            'name' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'rif' => 'required|string',
            'control' => 'required|string',
            'inputSumaPrecio' => 'required|numeric',
            'divisas' => 'required|string',
            'products' => 'required'
        ]);
        $products = $request->input('products');
        $foundProducts = []; 

        foreach ($products as $productId) {
            $product = Inventario::findOrFail($productId);
            if ($product) {
                ($product->tipo == "venta");
                $product->save();
                $foundProducts[] = $product;

            }
    
        }

        $factura = new Factura;
        $factura->name = $request->input('name') . " ".  $request->input('apellido');
        $factura->direccion = $request->input('direccion');
        $factura->telefono = $request->input('telefono');
        $factura->RIF = $request->input('rif');
        $factura->factura =  $request->has('factura') ? 1 : 0;
        $factura->control= $request->input('control');
        $factura->subtotal = $request->input('inputSumaPrecio');
        $factura->divisa = $request->input('divisas');
        $factura->products = json_encode($products);
        $factura->tasa_dia = Divisa::where("name", $request->input('divisas'))->first()->tasa;
        $factura->save();


        // $fecha = Carbon::now()->format('Y-m-d');;

        //     $fechaExistente = Fecha::whereDate('fecha', $fecha)->first();
    
        //     if (!$fechaExistente) {
        //         $fechaExistente = Fecha::create(['fecha' => $fecha]);
        //     }
        //     //deudas
        //     $libroVenta = new LibroDiario;
        //     $libroVenta->concepto="Venta";
        //     $libroVenta->debeIdMayor = ["1"];
        //     $libroVenta->haberIdMayor = null;
        //     $libroVenta->debe = "[\"". number_format((float)$factura->subtotal,2)."\"]";
        //     $libroVenta->haber = "[\"0\"]";
        //     $libroVenta->fecha_id = $fechaExistente->id; 
        //     $libroVenta->fecha = $fecha;
        //     $libroVenta->save();
        //     $libroMayorController = new LibroMayorController();
        //     $libroMayorController->calculateBalance("1");

        
        if(!$request->input('cliente')){
            $client = new Cliente;
            $client->name =   $factura->name;
            $client->fecha_nacimiento =$request->input("fechaNacimiento");
            $client->telefono = $request->input("telefono");
            $client->direccion = $request->input("direccion");
            $client->cedula =  $request->input("cedula");
            $client->correo =  $request->input("correo");

            $client->save();
        }


        if($request->input('factura') == "on"){
            $pdf = app('dompdf.wrapper');
            $factura->products = $foundProducts;
            $facturaArray = $factura->toArray();

            $pdf->loadView('factura.factura', compact('factura'));      
            return $pdf->stream('Factura.pdf');

        }

        return redirect()->route('factura.index')->with('success',$success);   
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $success = array("message" => "Factura creada Satisfactoriamente", "alert" => "success");
        $request->validate([
            'name' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'rif' => 'required|string',
            'control' => 'required|string',
            'inputSumaPrecio' => 'required|numeric',
            'divisas' => 'required|string',
        ]);
        $orden = ordenEntrega::findOrFail($request->input('ordenId'));

        $products =  $orden->ordenInventario;
        $productsId = [];

        foreach ($products as $product) {
   
            ($product->tipo == "venta") ?$product->disponibilidad =  2 : $product->disponibilidad = 1;
            $product->alquiler = null;
            array_push($productsId,$product->id ) ;
            $product->save();
        }
        ordenEntrega::find($request->input('ordenId'))->delete();

        $factura = new Factura;
        $factura->name = $request->input('name');
        $factura->direccion = $request->input('direccion');
        $factura->telefono = $request->input('telefono');
        $factura->RIF = $request->input('rif');
        $factura->factura =  $request->has('factura') ? 1 : 0;
        $factura->control= $request->input('control');
        $factura->subtotal = $request->input('inputSumaPrecio');
        $factura->divisa = $request->input('divisas');
        $factura->products =json_encode($productsId);
        $factura->tasa_dia =Divisa::where("name", $request->input('divisas'))->first()->tasa;

        

        $factura->save();


        // $fecha = Carbon::now()->format('Y-m-d');;

        // $fechaExistente = Fecha::whereDate('fecha', $fecha)->first();
        // $libroMayorController = new LibroMayorController();


        // if (!$fechaExistente) {
        //     $fechaExistente = Fecha::create(['fecha' => $fecha]);
        // }

        // if($orden->precio === $orden->abonado) {

        //     $libroVenta = new LibroDiario;
        //     $libroVenta->concepto="Venta";
        //     $libroVenta->debeIdMayor =  ["1"] ;
        //     $libroVenta->haberIdMayor = null;
        //     $libroVenta->debe = "[\"". number_format((float)$factura->subtotal,2)."\"]" ;
        //     $libroVenta->haber ="[\"0\"]";
        //     $libroVenta->fecha_id = $fechaExistente->id; 
        //     $libroVenta->fecha = $fecha;
        //     $libroVenta->save();
        //     $libroMayorController->calculateBalance("1");


        // }else {
        //     //cu
        // $libroDiario = new LibroDiario;
        // $libroDiario->concepto="Venta";
        // $libroDiario->debeIdMayor =  ["1"] ;
        // $libroDiario->haberIdMayor =  ["2"] ;
        // $libroDiario->debe = "[\"".( number_format((float)$orden->precio,2) -  number_format((float)$orden->abonado,2)  )."\"]";
        // $libroDiario->haber = "[\"".( number_format((float)$orden->precio,2) -  number_format((float)$orden->abonado,2)  )."\"]";
        // $libroDiario->fecha_id = $fechaExistente->id; 
        // $libroDiario->fecha = $fecha;
        // $libroDiario->save();
        // $libroMayorController->calculateBalance("2");
        // $libroMayorController->calculateBalance("1");

        // }



        if($request->input('factura') == "on"){
            $pdf = app('dompdf.wrapper');
            $factura->products = json_decode($request->input('products'));
            $facturaArray = $factura->toArray();

            $pdf->loadView('factura.factura', compact('factura'));      
                  return $pdf->download('mi-archivo.pdf');

        }

        return redirect()->route('factura.index')->with('success',$success);   
     }
    

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('factura.index')->with('success', 'Factura Borrada');
    }
    
}
