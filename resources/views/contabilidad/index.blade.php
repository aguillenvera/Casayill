@extends('layouts.master')
@section('css')
<!-- Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Contabilidad</h4>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
                        <!--Row-->
                        @if(Session::has('success'))
                            <div class="alert alert-{{ session('success.alert') }} alert-dismissible fade show" role="alert">
                                {{ session('success.message') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div id="alert-container"></div> <!-- Contenedor para las alertas -->

						<div class="row row-deck">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"></h3>
                                        <div class="form-group">
                                                <label for="fecha">Buscar:</label>
                                                <input type="text" id="search" name="search" class="form-control" placeholder="buscador">
                                            </div>
                                            <div class="card-options d-flex flex-wrap  flex-column flex-sm-row">
                                                <div class="btn-group ml-5 mb-2">
                                                    <a class="btn btn-primary  btn-responsive" href="{{ route('contabilidad.create') }}">
                                                        <i class="fa fa-plus mr-2"></i>Añadir nuevo registro
                                                    </a>
                                                </div>
                                                <div class="btn-group ml-5 mb-2">
                                                    <a class="btn btn-danger  btn-responsive" href="{{ route('index') }}">
                                                        Regresar
                                                    </a>
                                                </div>
                                            </div>
                                            
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="table" class=" table table-bordered text-nowrap key-buttons" style="border-color:#eff0f6;">
                                                <thead style="border-color:#eff0f6;">
                                                    <th class="border-bottom-0">Nombre del proveedor/persona</th>
                                                    <th class="border-bottom-0">Monto</th>
                                                    <th class="border-bottom-0">Fecha inicial de la deuda</th>
                                                    <th class="border-bottom-0">Fecha de pago</th>
                                                    <th class="border-bottom-0">Estado</th>
                                                    <th class="border-bottom-0">Descripcion</th>
                                                    <th style="border-color:#eff0f6;">Funciones</th>

                                                    @if(Auth::user()->isSuper())

                                                    <th style="border-color:#eff0f6;"></th>
                                                    <th style="border-color:#eff0f6;"></th>
                                                    @endif
                                                </thead>
                                                <tbody id="contentTable">
                                                    @if($contabilidades->isNotEmpty())
                                                        @foreach($contabilidades as $producto)
                                                            <tr class="bold producto-row">
                                                                <td>{{$producto->nombre}} </td>
                                                                <td>{{ number_format($producto->monto, 2) }} $</td>
                                                                <td>{{ Carbon\Carbon::parse($producto->fecha_deuda)->format('d/m/Y') }}</td>
                                                                <td>{{ $producto->fecha_pago ? Carbon\Carbon::parse($producto->fecha_pago)->format('d/m/Y') : 'S/F'  }}</td>
                                                                <td>{{$producto->estado}}</td>
                                                                <td>{{$producto->descripcion}}</td>
                                                            
                                                                <td class="d-flex flex-row bd-highlight">
                                                                   
                                                                    @if(Auth::user()->isSuper())
                                                                    @if($producto->estado === 'pendiente')
                                                                        <!-- Formulario para cancelar la deuda -->
                                                                        <form action="{{ route('cancelarDeuda', $producto->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-xs btn-success mr-2">Cancelar</button>
                                                                        </form>
                                                                    @else
                                                                        <span></span>
                                                                    @endif

                                                                        <a title="Editar Producto" class="btn btn-primary btn-xs mr-2" href="{{ route('contabilidad.edit', $producto->id) }}" ><span class="fa fa-pencil"></span></a>

                                                                        <form id="deleteForm" action="{{ route('contabilidad.destroy', $producto) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="btn btn-danger btn-xs" onclick="confirmDelete()" type="button"><span class="fa fa-trash"></span></button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8">No hay productos!</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<!--End row-->
					</div>
				</div><!-- end app-content-->
            </div>
            
@endsection
@section('js')
<!-- Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables.js')}}"></script>
<!-- Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script>
    function confirmDelete() {
        if (confirm("¿Está seguro de que desea eliminar este elemento?")) {
            document.getElementById('deleteForm').submit();
        }
    }
   async function gift() {
    if (confirm("¿Está seguro de que desea regalar o prestar este elemento?")) {  
        document.getElementById('giftForm').submit();
    }
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const productoRows = document.querySelectorAll('.producto-row');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();

            document.getElementById("searchTerm").value =  searchTerm;

            productoRows.forEach(function (row) {
                const textoFila = row.innerText.toLowerCase();

                if (textoFila.includes(searchTerm)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        });
    });
</script>


<script type="text/javascript">
    var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            console.log(dataURL);
            xmlDoc = $.parseXML(dataURL),
            $xml = $(xmlDoc),
            $('#xmltext').val(dataURL);
        };
        reader.readAsText(input.files[0]);
    };
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchPendingDebts() {
            fetch('{{ route('checkPendingDebts') }}')
                .then(response => response.json())
                .then(data => {
                    showAlerts(data);
                })
                .catch(error => console.error('Error:', error));
        }

        function showAlerts(deudas) {
            let alertContainer = document.getElementById('alert-container');
            alertContainer.innerHTML = ''; // Limpiar alertas anteriores

            deudas.forEach(deuda => {
                let alert = document.createElement('div');
                alert.className = 'alert alert-warning';
                alert.textContent = `La deuda de ${deuda.nombre} de ${deuda.monto} está pendiente desde ${deuda.fecha_deuda}.`;
                alertContainer.appendChild(alert);

                // Mostrar la alerta
                setTimeout(() => {
                    alert.classList.add('hidden');
                }, 5000); // Ocultar la alerta después de 5 segundos
            });
        }
        
         // Verificar alquileres vencidos cada 30 segundos
         setInterval(() => {
            fetchPendingDebts();
        }, 30000);

        // Verificar deudas pendientes inmediatamente al cargar la página
        fetchPendingDebts();
    });
</script>

<style>
    .btn-responsive {
        width: 200px;
    }
</style>
@endsection
