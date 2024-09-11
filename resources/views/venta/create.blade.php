@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Vender producto</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('index') }}">Site Panel</a></li>
									<li class="breadcrumb-item active" aria-current="page">Vender Productos</li>
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
										<div class="card-title">Vender producto</div>
                                        <div class="btn-group ml-5 mb-0">
											</div>
                                    </div>
                                    <div class="card-body">
                                        
                                    <form action="{{ route('venta.store') }}" method="POST">
                                            @csrf

                                            <!-- Client Selection or Creation -->
                                            <div class="form-group">
                                                <label for="cliente_id">Seleccione un Cliente</label>
                                                <select name="cliente_id" id="cliente_id" class="form-control" >
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

                                            <!-- Product Selection -->
                                            <div class="form-group">
                                                <label for="productos">Seleccione los Productos</label>
                                                <select name="producto_id[]" id="productos" class="form-control select2" multiple="multiple" >

                                                    @foreach($productos as $producto)
                                                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
                                                            {{ $producto->producto }} - {{ $producto->marca }} - Talla: {{ $producto->talla }} - Cantidad(Stock): {{ $producto->cantidad }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Product Quantities -->
                                            <div id="producto-detalles"></div>

                                            <!-- Descuento -->
                                            <div class="form-group">
                                                <label for="descuento">Descuento (%)</label>
                                                <input type="number" name="descuento" id="descuento" class="form-control" placeholder="Ingrese el descuento" min="0" max="100" step="0.01">
                                            </div>

                                            <!-- Total Price -->
                                            <div class="form-group">
                                                <label for="total_precio">Valor total del producto (USD)</label>
                                                <input type="text" id="total_precio" name="total_precio" class="form-control" readonly value="0.00">
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

                                            <!-- Submit Button -->
                                            <button type="submit" class="btn btn-primary">Realizar Venta</button>
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
<!--Select2 js -->
    <script>
    function redirectIndex() {
            setTimeout(function() {
            window.location.href = "{{ route('venta.index') }}";
        }, 4000); 
        };
    </script>

<script>
    $(document).ready(function() {
        // Lógica de selección de cliente
        $('#cliente_id').on('change', function() {
            if ($(this).val() === "") {
                $('#nuevoClienteFields').show();
            } else {
                $('#nuevoClienteFields').hide();
            }
        });

        // Envío del formulario
        $('form').submit(function() {
            calcularPrecioTotal(); // Recalcular el total antes de enviar
        });

        // Selección de producto y cantidad
        $('#productos').on('change', function() {
            let selectedProducts = $(this).val();
            let productosContainer = $('#producto-detalles');
            productosContainer.empty();

            selectedProducts.forEach(function(productId) {
                let selectedOption = $('#productos option[value="' + productId + '"]');
                let productoDetails = `
                    <div class="form-group">
                        <label>${selectedOption.text()}</label>
                        <input type="number" name="productos[${productId}][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
                        <input type="hidden" name="productos[${productId}][producto_id]" value="${productId}">
                    </div>
                `;
                productosContainer.append(productoDetails);
            });

            calcularPrecioTotal();
        });

        // Calcular el precio total
        $('#producto-detalles').on('input', 'input[type="number"]', function() {
            calcularPrecioTotal();
        });

        // Actualizar el total cuando se cambia el descuento
        $('#descuento').on('input', function() {
            calcularPrecioTotal();
        });

        // Función para calcular el precio total con descuento
        function calcularPrecioTotal() {
            let total = 0;
            $('#producto-detalles').find('input[type="number"]').each(function() {
                let cantidad = parseInt($(this).val()) || 0;
                let precio = parseFloat($('#productos option[value="' + $(this).siblings('input[type="hidden"]').val() + '"]').data('precio'));
                total += cantidad * precio;
            });

            // Aplicar descuento
            let descuento = parseFloat($('#descuento').val()) || 0;
            total -= total * (descuento / 100);

            $('#total_precio').val(total.toFixed(2));
            convertirTotal();
        }

        // Función para convertir el total a la moneda seleccionada
        function convertirTotal() {
            let total = parseFloat($('#total_precio').val()) || 0;
            let moneda = $('#moneda').val();
            let tipoCambio = @json($tiposDeCambio);

            // Asegúrate de que tiposDeCambio esté en el formato correcto
            let tasaDolares = tipoCambio['USD'] || 1;
            let tasaPesos = tipoCambio['COP'] || 1;
            let tasaBolivares = tipoCambio['Bs'] || 1;

            // Convertir total a otras monedas
            let totalConvertidoPesos = total * tasaPesos;
            let totalConvertidoBolivares = total * tasaBolivares;

            $('#total_pesos').val(totalConvertidoPesos.toFixed(2));
            $('#total_bolivares').val(totalConvertidoBolivares.toFixed(2));
        }
    });
</script>


    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- 
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script> -->
@endsection
