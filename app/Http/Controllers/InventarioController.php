<?php

namespace App\Http\Controllers;

use App\Exports\AlquiladoExport;
use App\Exports\disponibleExport;
use App\Exports\InventarioExport;
use App\Imports\InventarioImport;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexVenta()
    {
        $inventario = Inventario::where("tipo", 'venta')->get();
        return view("inventario.indexVenta", compact("inventario"));
        
    }

    public function indexAlquiler()
    {
        $inventario = Inventario::where('tipo', 'alquiler')->get();
        return view("inventario.indexAlquiler", compact("inventario"));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateInventory = $request->validate([
            'codigo' => 'nullable|string',
            'producto' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string',
            'tipo' => 'required|string',
            'color' => 'required|string',
            'cantidad' => 'required|numeric',
            'almacen' =>  'required|string',
        ]);

        $inventory = Inventario::create($validateInventory);

        $success = array("message" => "Producto agregado correctamente", "alert" => "success");

       // Redirigir según el tipo
        switch ($inventory->tipo) {
            case 'venta':
                return to_route('inventario.indexVenta')->with('success', $success);
                break;
            case 'alquiler':
                return to_route('inventario.indexAlquiler')->with('success', $success);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Inventario::find($id);
        return view('inventario.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'producto' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string',
            'tipo' => 'required|string',
            'color' => 'required|string',
            'cantidad' => 'required|numeric',
            'almacen' => 'required|string',

        ]);
    
        $producto = Inventario::findOrFail($id);
    
        $producto->producto = $request->input('producto');
        $producto->marca = $request->input('marca');
        $producto->talla = $request->input('talla');
        $producto->precio = $request->input('precio');
        $producto->almacen = $request->input('almacen');
        $producto->tipo = $request->input('tipo');
        $producto->color = $request->input('color');
        $producto->cantidad = $request->input('cantidad');
    
        $producto->update();
   
    
        $success = array("message" => "Producto actualizado correctamente", "alert" => "success");
        // Redirigir según el tipo
        switch ($producto->tipo) {
            case 'venta':
                return to_route('inventario.indexVenta')->with('success',$success);
                break;
            case 'alquiler':
                return to_route('inventario.indexAlquiler')->with('success',$success);
                break;
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventory = Inventario::findOrFail($id);
        $inventory->delete();
        
        $success = array("message" => "Producto eliminado correctamente", "alert" => "success");

        // Redirigir según el tipo
        switch ($inventory->tipo) {
            case 'venta':
                return to_route('inventario.indexVenta')->with('success',$success);
                break;
            case 'alquiler':
                return to_route('inventario.indexAlquiler')->with('success',$success);
                break;
        }
    }

    public function Exportacion(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $query = Inventario::query();
    
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('codigo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('producto', 'like', '%' . $searchTerm . '%')
                    ->orWhere('marca', 'like', '%' . $searchTerm . '%')
                    ->orWhere('precio', 'like', '%' . $searchTerm . '%')
                    ->orWhere('talla', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tipo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('color', 'like', '%' . $searchTerm . '%')
                    ->orWhere('cantidad', 'like', '%' . $searchTerm . '%')
                    ->orWhere('almacen', 'like', '%' . $searchTerm . '%')
                    ->orWhere('disponibilidad', 'like', '%' . $searchTerm . '%');
            });
        }
    
        $data = $query->get();
    
        // Devuelve una instancia de la clase InventarioExport con los datos filtrados
        return Excel::download(new InventarioExport($data), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    
    public function ExportacionAlquilado(){
        return Excel::download(new AlquiladoExport(), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function ExportacionDisponible(){
        return Excel::download(new disponibleExport(), 'Productos.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function Importacion(Request $request) 
    {
        // Subir el archivo y obtener su ruta
        $file = $request->file('excel');
    
        // Cargar el archivo Excel
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
    
        // Asumiendo que la primera fila es el encabezado, empieza en la segunda fila
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // saltar el encabezado
            }

            // Crear el bien nacional
            Inventario::create([
                'codigo' => $row[0],
                'producto' => $row[1],
                'marca' => $row[2],
                'precio' => $row[3],
                'talla' => $row[4],
                'tipo' => $row[5],
                'color' => $row[6],
                'cantidad' => $row[7],
                'almacen' => $row[8],
            ]);
        }
    
        $success = array("message" => "Importacion del inventario realizada con exito.", "alert" => "success");

        return back()->with('success', $success);
    
    }

    public function ExportVenta()
    {
    
        $inventario = Inventario::where("tipo", 'venta')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Agregar encabezados
        $sheet->setCellValue('A1', 'Codigo');
        $sheet->setCellValue('B1', 'Producto');
        $sheet->setCellValue('C1', 'Marca');
        $sheet->setCellValue('D1', 'Precio');
        $sheet->setCellValue('E1', 'Talla');
        $sheet->setCellValue('F1', 'Tipo');
        $sheet->setCellValue('G1', 'Color');
        $sheet->setCellValue('H1', 'Cantidad');
        $sheet->setCellValue('I1', 'Almacen');
        // Añade más encabezados según sea necesario
        
        // Agregar datos
        $row = 2; // Comienza en la fila 2 para los datos
        foreach ($inventario as $item) {
            $sheet->setCellValue('A' . $row, $item->codigo);
            $sheet->setCellValue('B' . $row, $item->producto);
            $sheet->setCellValue('C' . $row, $item->marca);
            $sheet->setCellValue('D' . $row, $item->precio);
            $sheet->setCellValue('E' . $row, $item->talla);
            $sheet->setCellValue('F' . $row, $item->tipo);
            $sheet->setCellValue('G' . $row, $item->color);
            $sheet->setCellValue('H' . $row, $item->cantidad);
            $sheet->setCellValue('I' . $row, $item->almacen);
            // Agrega más columnas según sea necesario
            $row++;
        }
        
        // Crear un objeto Writer para guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Definir el nombre del archivo
        $filename = 'InventarioVenta.xlsx';
        
        // Forzar descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Enviar el archivo al navegador
        $writer->save('php://output');
        
        exit;
    }

    public function ExportAlquiler()
    {
    
        $inventario = Inventario::where("tipo", 'alquiler')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Agregar encabezados
        $sheet->setCellValue('A1', 'Codigo');
        $sheet->setCellValue('B1', 'Producto');
        $sheet->setCellValue('C1', 'Marca');
        $sheet->setCellValue('D1', 'Precio');
        $sheet->setCellValue('E1', 'Talla');
        $sheet->setCellValue('F1', 'Tipo');
        $sheet->setCellValue('G1', 'Color');
        $sheet->setCellValue('H1', 'Cantidad');
        $sheet->setCellValue('I1', 'Almacen');
        // Añade más encabezados según sea necesario
        
        // Agregar datos
        $row = 2; // Comienza en la fila 2 para los datos
        foreach ($inventario as $item) {
            $sheet->setCellValue('A' . $row, $item->codigo);
            $sheet->setCellValue('B' . $row, $item->producto);
            $sheet->setCellValue('C' . $row, $item->marca);
            $sheet->setCellValue('D' . $row, $item->precio);
            $sheet->setCellValue('E' . $row, $item->talla);
            $sheet->setCellValue('F' . $row, $item->tipo);
            $sheet->setCellValue('G' . $row, $item->color);
            $sheet->setCellValue('H' . $row, $item->cantidad);
            $sheet->setCellValue('I' . $row, $item->almacen);
            // Agrega más columnas según sea necesario
            $row++;
        }
        
        // Crear un objeto Writer para guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Definir el nombre del archivo
        $filename = 'IventarioAlquiler.xlsx';
        
        // Forzar descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Enviar el archivo al navegador
        $writer->save('php://output');
        
        exit;
    }
    
}
