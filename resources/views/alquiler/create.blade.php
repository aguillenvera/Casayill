@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Registrar Alquiler</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('index') }}">Site Panel</a></li>
									<li class="breadcrumb-item active" aria-current="page">Create Site</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
                        <!-- Row -->
                        @if(Session::has('success'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
			            @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
                                    <div class="card-header">
										<div class="card-title">Registrar un Alquiler</div>
                                        <div class="card-options">
                                        <div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-danger" href="{{route('index')}}">Regresar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{ route('alquiler.store') }}" method="POST">
                                        @csrf

                                        <!-- Client Selection or Creation -->
                                        <div class="form-group">
                                                <label for="cliente_id">Seleccione un Cliente</label>
                                                <select name="cliente_id" id="cliente_id" class="form-control">
                                                <option disabled selected>Seleccione un cliente o "Nuevo Cliente" para registrarlo</option>
                                                    <option value="">Nuevo Cliente</option>
                                                    @foreach($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="nuevoClienteFields" style="display: none;">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="text" name="cedula" id="cedula" class="form-control input-sm" placeholder="cedula de identidad">
                                                </div>
                                                    <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="nombre">
                                                </div>
                                                    <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="text" name="apellido" id="apellido" class="form-control input-sm" placeholder="apellido">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="direccion">
                                                </div>
                                                
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="email" name="correo" id="correo" class="form-control input-sm" placeholder="Correo del cliente">
                                                </div>
                                                <span class="card-title">Fecha de Nacimiento</span>
                                                <div class="input-group mb-3">
                                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control input-sm">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                    <input type="text" name="telefono" id="telefono" class="form-control input-sm" placeholder="telefono">
                                                </div>
                                                <!-- Otros campos del cliente -->
                                            </div>

                    <!-- Selección de Producto -->
                    <div class="form-group">
                        <label for="producto_id">Seleccione un Producto</label>
                        <select name="producto_id" class="form-control" required>
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->producto }} - {{ $producto->marca }} (Disponible: {{ $producto->cantidad }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fecha de Alquiler -->
                    <div class="form-group">
                        <label for="fecha_alquiler">Fecha de Alquiler</label>
                        <input type="date" name="fecha_alquiler" class="form-control" required>
                    </div>

                    <!-- Cantidad -->
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" required>
                    </div>

                    <!-- Precio -->
                    <div class="form-group">
                        <label for="precio">Precio del producto (USD)</label>
                        <input type="text" name="precio" id="precio" class="form-control" required>
                    </div>

                    <!-- Converted Total Price -->
                    <div class="form-group">
                            <label for="total_pesos">Total Convertido en pesos (COP)</label>
                            <input type="text" id="total_pesos" class="form-control" readonly value="0.00">
                        </div>
                        <div class="form-group">
                            <label for="total_bolivares">Total Convertido n bolivares (BS)</label>
                            <input type="text" id="total_bolivares" class="form-control" readonly value="0.00">
                        </div>


                    <!-- Botón de Enviar -->
                    <button type="submit" class="btn btn-primary">Registrar Alquiler</button>
                    <a class="btn btn-danger ml-5" href="{{route('index')}}">Cancelar</a>

                </form>
                                    </div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div>
				</div><!-- end app-content-->
			</div>

            
@endsection
@section('js')

                <script>
                    $(document).ready(function() {
                        $('#cliente_id').on('change', function() {
                            if ($(this).val() === "") {
                                $('#nuevoClienteFields').show();
                            } else {
                                $('#nuevoClienteFields').hide();
                            }
                        });
// Function to convert total to selected currency
function convertirTotal() {
        let precio = parseFloat($('#precio').val()) || 0;

        // Si no hay un precio válido, no se hace la conversión
        if (isNaN(precio)) {
            $('#total_pesos').val("0.00");
            $('#total_bolivares').val("0.00");
            return;
        }

        // Obtener los tipos de cambio del JSON
        let tiposDeCambio = @json($tiposDeCambio);

        // Obtener las tasas de cambio
        let tasaPesos = tiposDeCambio['COP'] || 1;
        let tasaBolivares = tiposDeCambio['Bs'] || 1;

        // Convertir el precio a otras monedas
        let totalConvertidoPesos = precio * tasaPesos;
        let totalConvertidoBolivares = precio * tasaBolivares;

        // Actualizar los campos con el total convertido
        $('#total_pesos').val(totalConvertidoPesos.toFixed(2));
        $('#total_bolivares').val(totalConvertidoBolivares.toFixed(2));
    }

    // Ejecutar la conversión al cargar la página y cuando el valor del precio cambie
    $('#precio').on('input', convertirTotal);
    convertirTotal(); // Llamar para inicializar los valores
                    });
                    
                </script>

<!--Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
