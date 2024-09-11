@extends('layouts.master')

@section('css')
<!-- Select2 css -->
<link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('page-header')
<!-- Page header -->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">Editar venta</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('venta.index') }}">Ventas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Venta</li>
        </ol>
    </div>
</div>
<!-- End Page header -->
@endsection

@section('content')
<!-- Row -->
@if(Session::has('success'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
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
                <div class="card-title">Editar Venta</div>
            </div>
            <div class="card-body">
            <form action="{{ route('venta.update', $venta->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Client Selection or Creation -->
                    <div class="form-group">
                        <label for="cliente_id">Seleccione un Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control">
                            <option value="">Nuevo Cliente</option>
                            @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $venta->clientes->id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellido }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Mostrar campos de nuevo cliente si es necesario -->
                    <div id="nuevoClienteFields" style="{{ $venta->clientes ? 'display: none;' : '' }}">
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" name="cedula" class="form-control" placeholder="Cédula" value="{{ old('cedula', $venta->cliente->cedula ?? '') }}">
                        </div>
                        <!-- Otros campos del cliente -->
                    </div>

                    <!-- Product Selection -->
                    <div class="form-group">
                        <label for="productos">Seleccione los Productos</label>
                        <select name="producto_id[]" id="productos" class="form-control select2" multiple="multiple">
                            @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}" {{ in_array($producto->id, $venta->productos->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $producto->producto }} - {{ $producto->marca }} - Talla: {{ $producto->talla }} - Cantidad(Stock): {{ $producto->cantidad }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Quantities -->
                    <div id="producto-detalles">
                        <div class="form-group">
                            <label>{{ $venta->productos->producto }} - {{ $venta->productos->marca }} - Cantidad comprada: {{ $venta->cantidad }} </label>
                            <input type="number" name="productos[{{ $venta->productos->id }}][cantidad]" class="form-control" placeholder="Ingrese la cantidad de productos que desea agregar a los ya comprados" min="1" value="{{ old('productos.' . $producto->id . '.cantidad') }}" required>
                            <input type="hidden" name="productos[{{ $producto->id }}][producto_id]" value="{{ $producto->id }}">
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="form-group">
                        <label for="total_precio">Total a Pagar</label>
                        <input type="text" id="total_precio" name="total_precio" class="form-control" readonly value="{{ number_format($venta->total, 2) }}">
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

                    <!-- Discount -->
                    <div class="form-group">
                        <label for="descuento">Descuento (%)</label>
                        <input type="number" id="descuento" name="descuento" class="form-control" min="0" max="100" value="{{ old('descuento', $venta->descuento) }}">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Actualizar Venta</button>
                    <a href="{{ route('venta.index') }}" class="btn btn-danger">Cancelar</a>
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
<!-- Select2 js -->
<script>
$(document).ready(function() {
    let ventaPrecioInicial = parseFloat('{{ $venta->precio }}'); // Precio inicial de la venta

    $('#cliente_id').on('change', function() {
        if ($(this).val() === "") {
            $('#nuevoClienteFields').show();
        } else {
            $('#nuevoClienteFields').hide();
        }
    });

    $('form').submit(function() {
        calcularPrecioTotal(); // Recalcular el total antes de enviar
    });

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

    $('#producto-detalles').on('input', 'input[type="number"]', function() {
        calcularPrecioTotal();
    });

    $('#descuento').on('input', function() {
        calcularPrecioTotal(); // Recalcular el total cuando se cambie el descuento
    });

    // Function to calculate the total price based on selected products and quantities
function calcularPrecioTotal() {
    let totalPrecio = ventaPrecioInicial; // Comenzar con el precio ya existente
    let descuento = parseFloat($('#descuento').val()) || 0;
    let tasasDeCambio = @json($tiposDeCambio);

    // Iterar sobre cada producto seleccionado y calcular el precio total
    $('#producto-detalles').find('input[type="number"]').each(function() {
        let cantidad = parseFloat($(this).val()) || 0;
        let productoId = $(this).siblings('input[type="hidden"]').val();
        let precioUnitario = parseFloat($('#productos option[value="' + productoId + '"]').data('precio')) || 0;

        let precioProducto = precioUnitario * cantidad;
        let precioConDescuento = precioProducto - (precioProducto * (descuento / 100));

        totalPrecio += precioConDescuento;
    });

    // Actualizar el precio total en el formulario
    $('#total_precio').val(totalPrecio.toFixed(2));

    // Convertir y actualizar el precio total en COP y BS
    let totalPesos = totalPrecio * tasasDeCambio.COP;
    let totalBolivares = totalPrecio * tasasDeCambio.Bs;

    $('#total_pesos').val(totalPesos.toFixed(2));
    $('#total_bolivares').val(totalBolivares.toFixed(2));
}

    // Inicializar Select2
    $('.select2').select2();

    // Inicializar el total si hay productos precargados
    calcularPrecioTotal();
});
</script>



<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
