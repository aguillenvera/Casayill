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
								<h4 class="page-title">Ordenes</h4>
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
                                        <div class="form-group">
                                                <label for="fecha">Buscar:</label>
                                                <input type="text" id="search" name="search" class="form-control" placeholder="buscador">
                                            </div>
										<div class="card-options">

											<div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-primary" href="{{route('orden.create')}}"><i class="fa fa-plus mr-2"></i>Añadir Ordenes</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                            <table id="example" class="table table-bordered text-nowrap key-buttons " style="border-color:#eff0f6;">
                                                <thead>
                                                    <th class="border-bottom-0">ID</th>
                                                    <th class="border-bottom-0">nombre</th>
                                                    <th class="border-bottom-0">apellido</th>
                                                    <th class="border-bottom-0">Direccion</th>
                                                    <th class="border-bottom-0">telefono</th>
                                                    <th class="border-bottom-0">Faltante</th>
                                                    <th class="border-bottom-0">precio</th>
                                                    <th class="border-bottom-0">prestamo</th>
                                                    <th class="border-bottom-0">entrega</th>
                                                    <th class="border-bottom-0">Lista de los Productos</th>
                                                    <th style="border-color:#eff0f6;"></th>
                                                    <th style="border-color:#eff0f6;"></th>


                                                </thead>
                                                <tbody >
                                                    @if($ordenes->isNotEmpty())
                                                        @foreach($ordenes as $orden)
                                                            <tr class="bold orden-row">
                                                                <td>{{$orden->id}}</td>
                                                                <td>{{$orden->name}}</td>
                                                                <td>{{$orden->apellido}}</td>
                                                                <td>{{$orden->direccion}}</td>
                                                                <td>{{$orden->telefono}}</td>
                                                                <td>{{$orden->precio - $orden->abonado}}</td>
                                                                <td>{{$orden->precio}}</td>
                                                                <td>{{$orden->fecha_de_prestamo}}</td>
                                                                <td @if(strtotime($orden->fecha_de_entrega) < strtotime(date('Y-m-d'))) class="bg-danger text-white" @endif>
                                                                    {{$orden->fecha_de_entrega}}
                                                                </td>
                                                                <td>           <details>
                                                                <summary>Productos</summary>
                                                                <ul>
                                                                    @forEach( $orden->ordenInventario as $product)
                                                                         <li>{{$product->producto}}</li>
                                                                    @endforeach
</ul>
                                                                </details></td>

                                                                <td><a class="btn btn-success btn-xs" href="{{ route('factura.crear', ['id' => $orden->id]) }}" ><span class="fa fa-cart-plus"></span></a></td>
                                                       
                                                     
                                               
                                                            </tr>
                                            
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8">No one there!</td>
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
            <div class="modal" id="modaldemo1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">File Upload</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('orden.store') }}" role="form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="custom-file">
                                            <input type="file" id="xmldata" name="xmldata" class="custom-file-input" data-height="250" accept="text/xml" onchange='openFile(event)'/>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-lg btn-primary">Upload</button>
                                </div>
                            </form>
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
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const productoRows = document.querySelectorAll('.orden-row');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();

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


@endsection
