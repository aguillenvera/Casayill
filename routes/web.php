<?php

use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\CierreController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContabilidadController;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\IntercambioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Home Page
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboardgrap',[HomeController::class, 'dashboardgrap'])->name('dashboardgrap');
    Route::get('/profile',[UserController::class, 'profile'] )->name('profile');
    Route::patch('credentials', [UserController::class, 'postCredentials'] )->name('credentials');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/tours', function(){
        return view('jumbotron');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('oferta/index', [OfertasController::class, 'index'])->name('oferta.index');
    Route::post('oferta/send', [OfertasController::class, 'send'])->name('oferta.send');


});

Route::middleware([Authenticate::class])->group(function () {

    Route::resource('notificacion', NotificacionController::class);

    Route::resource('cliente', ClienteController::class);

    Route::resource('divisas', DivisaController::class);

    // Ruta para los inventarios
    Route::get('inventario/venta', [InventarioController::class, 'indexVenta'])->name('inventario.indexVenta');
    Route::get('inventario/alquiler', [InventarioController::class, 'indexAlquiler'])->name('inventario.indexAlquiler');
    Route::get('inventario/create', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('inventario/{id}/edit' , [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('inventario/{id}', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('inventario/{id}/destroy' , [InventarioController::class, 'destroy'])->name('inventario.destroy');
    Route::post('/export/inventario/venta', [InventarioController::class , 'ExportVenta'])->name('export.inventario.venta');
    Route::post('/export/inventario/alquiler', [InventarioController::class , 'ExportAlquiler'])->name('export.inventario.alquiler');
    
    // ruta para las ventas
    Route::get('Venta/index', [VentaController::class, 'index'])->name('venta.index');
    Route::get('Venta/create', [VentaController::class, 'create'])->name('venta.create');
    Route::post('Venta/store', [VentaController::class, 'store'])->name('venta.store');
    Route::get('Venta/edit/{id}', [VentaController::class, 'edit'])->name('venta.edit');
    Route::put('Venta/update/{id}', [VentaController::class, 'update'])->name('venta.update');
    Route::delete('Venta/delete/{id}', [VentaController::class, 'destroy'])->name('venta.delete');
    
    //Rutas para el alquiler
    Route::get('/alquiler/index', [AlquilerController::class, 'index'])->name('alquiler.index');
    Route::get('/alquiler/create', [AlquilerController::class, 'create'])->name('alquiler.create');
    Route::post('/alquiler/store', [AlquilerController::class, 'store'])->name('alquiler.store');
    Route::get('/alquiler/edit/{id}', [AlquilerController::class, 'edit'])->name('alquiler.edit');
    Route::put('/alquiler/update/{id}', [AlquilerController::class, 'update'])->name('alquiler.update');
    Route::delete('/alquiler/delete/{id}', [AlquilerController::class, 'destroy'])->name('alquiler.delete');
    Route::get('/check-overdue-alquileres', [AlquilerController::class, 'checkOverdueAlquileres']);
    Route::post('/alquiler/{id}/devolver', [AlquilerController::class, 'marcarComoDevuelto'])->name('alquiler.devuelto');
    Route::post('/alquileres/{id}/extend', [AlquilerController::class, 'extendRental'])->name('alquiler.extend');

    // Rutas de empleados
    Route::resource('empleado', EmpleadoController::class);
    Route::post('/import/empleado/nomina', [EmpleadoController::class , 'Importacion'])->name('empleado.import');    
    Route::post('/export/empleado/nomina', [EmpleadoController::class , 'ExportEmployed'])->name('empleado.export');

    // Rutas de nominas
    Route::resource('nomina', NominaController::class);

    // Ruta para los gastos
    Route::resource('gasto', GastoController::class);
    
    // Ruta para los ingrsos diarios
    Route::resource('ingreso', IngresoController::class);

    // Rutas para los intercambios
    Route::resource('intercambio', IntercambioController::class);

    //Ruta para la contabilidad
    Route::resource('contabilidad', ContabilidadController::class);
    Route::get('/check-pending-debts', [ContabilidadController::class, 'checkPendingDebts'])->name('checkPendingDebts');
    Route::post('/cancelar-deuda/{id}', [ContabilidadController::class, 'cancelarDeuda'])->name('cancelarDeuda');

    // Ruta para los recibos
    Route::get('/Ventas/{ventaProductoClientes}/generarRecibo', [VentaController::class,'generarRecibo'])->name('generar.recibo.venta');
    Route::get('/Alquileres/{alquiler}/generarRecibo', [AlquilerController::class,'generarRecibo'])->name('generar.recibo.alquiler');

    //Ruta para el cierre
    Route::get('cierre/index', [CierreController::class, 'index'])->name('cierre.index');

    // No se de su uso
    Route::get('/sales-summary' , [UploadController::class, 'salessummary'])->name('salessummary.upload');
    Route::get('/comps' , [UploadController::class, 'comps'])->name('comps.upload');
    Route::get('/voids' , [UploadController::class, 'voids'])->name('voids.upload');
    Route::get('/promos' , [UploadController::class, 'promos'])->name('promos.upload');
    Route::get('/payments' , [UploadController::class, 'payments'])->name('payments.upload');
    Route::get('/mixes' , [UploadController::class, 'mix'])->name('mix.upload');

    
    Route::get('user/{id}/edit' , [UserController::class, 'edit'])->name('user.edit');
    Route::get('user/{id}/destroy' , [UserController::class, 'destroy'])->name('user.destroy');
    
    
    Route::get('/export/alquilado', [InventarioController::class , 'ExportacionAlquilado'])->name('alquilado.export');
    Route::get('/export/disponible', [InventarioController::class , 'ExportacionDisponible'])->name('disponible.export');
    Route::post('/import/inventario', [InventarioController::class , 'Importacion'])->name('inventario.import');    

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
