<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();

        return view('empleado.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleado.create');
    }

    public function store(Request $request)
    {
        $validateEmployed = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'cedula' => 'required|max:150',
            'cargo' => 'required|string|max:150',
            'salario' => 'required|numeric'
        ]);

        Empleado::create($validateEmployed);

        $success = array("message" => "Empleado registrado exitosamente", "alert" => "success");

        return to_route('empleado.index')->with('success', $success);
    }

    public function edit($id)
    {
        $empleado = Empleado::find($id);
        return view('empleado.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $validateEmployed = $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido' => 'required|string|max:150',
            'cedula' => 'required|max:150',
            'cargo' => 'required|string|max:150',
            'salario' => 'required|numeric'
        ]);

        $employed = Empleado::findOrFail($id);
        $employed->update($validateEmployed);

        $success = array("message" => "Empleado actualizado exitosamente", "alert" => "success");

        return to_route('empleados.index')->with('success', $success);
    }

    public function destroy($id)
    {
        $employed = Empleado::findOrFail($id);
        $employed->delete();

        $success = array("message" => "Empleado eliminado exitosamente", "alert" => "success");

        return to_route('empleados.index')->with('success', $success); 
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
            Empleado::create([
                'nombre' => $row[0],
                'apellido' => $row[1],
                'cedula' => $row[2],
                'cargo' => $row[3],
                'salario' => $row[4],
            ]);
        }

        $success = array("message" => "Importacion de los empleados realizada con exito.", "alert" => "success");

        return back()->with('success', $success);
    }

    public function ExportEmployed()
    {
    
        $inventario = Empleado::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Agregar encabezados
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'Apellido');
        $sheet->setCellValue('C1', 'Cedula');
        $sheet->setCellValue('D1', 'Cargo');
        $sheet->setCellValue('E1', 'Salario');
        // Añade más encabezados según sea necesario
        
        // Agregar datos
        $row = 2; // Comienza en la fila 2 para los datos
        foreach ($inventario as $item) {
            $sheet->setCellValue('A' . $row, $item->nombre);
            $sheet->setCellValue('B' . $row, $item->apellido);
            $sheet->setCellValue('C' . $row, $item->cedula);
            $sheet->setCellValue('D' . $row, $item->cargo);
            $sheet->setCellValue('E' . $row, $item->salario);
            // Agrega más columnas según sea necesario
            $row++;
        }
        
        // Crear un objeto Writer para guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Definir el nombre del archivo
        $filename = 'Nomina-Empleados.xlsx';
        
        // Forzar descarga del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Enviar el archivo al navegador
        $writer->save('php://output');
        
        exit;
    }

}
