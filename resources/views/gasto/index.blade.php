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
								<h4 class="page-title">Gastos Diarios </h4>
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

						<div class="row row-deck">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"></h3>
                                   
										<div class="card-options">

											<div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-primary" href="{{route('gasto.create')}}"><i class="fa fa-plus mr-2"></i>Añadir gasto diario</a>
											</div>
											<div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-danger" href="{{route('index')}}">Regresar</a>
											</div>
										</div>
									</div>
									<div class="card-body">

                                         <!-- Formulario de filtrado -->
                                    <div class="mb-5">
                                        <form method="GET" action="{{ route('gasto.index') }}">
                                            <div class="form-group">
                                                <label for="fecha_inicio">Fecha Inicio</label>
                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_fin">Fecha Fin</label>
                                                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Filtrar</button>
                                            <a href="{{ route('gasto.index') }}"  class="btn btn-primary">Limpiar</a>
                                        </form>
                                    </div>

										<div class="table-responsive">
                                            <table id="example" class="table table-bordered text-nowrap key-buttons">
                                                <thead>
                                                    <th class="border-bottom-0">id</th>
                                                    <th class="border-bottom-0">Fecha del gasto</th>
                                                
                                                    @if(Auth::user()->isSuper())
                                                    <th class="border-bottom-0"></th>
                                                    <th class="border-bottom-0"></th>
                                                    @endif
                                                </thead>
                                                <tbody>
                                                    @if($gastos->isNotEmpty())
                                                        @foreach($gastos as $producto)
                                                            <tr class="bold producto-row">
                                                                <td>{{$producto->id}}</td>
                                                                <td>{{Carbon\Carbon::parse($producto->fecha)->format('d/m/Y')}} </td>

                                                                @if(Auth::user()->isSuper())
                                                                <!-- <td><a class="btn btn-primary btn-xs" href="{{ route('empleado.edit', $producto->id) }}" ><span class="fa fa-pencil"></span></a></td> -->
                                                                <td><a class="btn btn-primary btn-xs" title="ver detalle del gasto" href="{{ route('gasto.show', $producto->id) }}" >
                                                                        <span class="&#xF33E">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </td>
                                                               
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8">No one there!</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            
                                            <!-- Mostrar balance -->
                                            <h3>Balance: {{ number_format($balance, 2) }} $</h3>
                                            @if($balance > 0)
                                                <p>Deuda</p>
                                            @else
                                                <p>Calcule sus gastos</p>
                                            @endif
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<!--End row-->
					</div>
				</div><!-- end app-content-->
            </div>
            <div class="modal" id="modaldemo1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">File Upload</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
          
                        <div class="modal-footer">
                            <button class="btn btn-light" data-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
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
<script>
        function confirmDelete() {
            if (confirm("¿Está seguro de que desea eliminar este elemento?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>


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
@endsection
