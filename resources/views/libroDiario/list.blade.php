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
								<h4 class="page-title">Libro diario</h4>
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
                                                <a class="btn btn-primary" href="{{route('libroDiario.create')}}"><i class="fa fa-plus mr-2"></i>Añadir un  Libro Diario</a>
											</div>
								
										</div>
									</div>
                                    <div class="card-body">
                                    <form id="searchForm" class="mb-3">
                                        <div class="form-group">
                                            <label for="fecha">Buscar por Fecha:</label>
                                            <input type="date" id="fecha" name="fecha" class="form-control">
                                        </div>
                                        <button type="button" onclick="searchBooks()" class="btn btn-primary">Buscar</button>
                                        <button  type="button" onclick="clearSearch()" class="btn btn-danger" >Cancelar</button>
                                    </form>
                                        <ul id="resultList" class="list-group">
                                        @foreach($fechas as $fecha)
                                            <a href="{{ route('libros-por-fecha', ['fecha' => $fecha]) }}"> <li class="list-group-item"> Libro Diario {{ $fecha }} </li> </a>
                                        @endforeach
                                        </ul>
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
    function clearSearch(){
        $('#fecha').val('');
         searchBooks();
    }
    function searchBooks() {
        let fecha = $('#fecha').val();

        let fechas = @json($fechas)

        $('#resultList').empty();

        fechas.forEach(function (result) {
            if (fecha === '' || result === fecha) {
                $('#resultList').append('<li class="list-group-item"><a href="#"> Libro Diario ' + result + '</a></li>');

            }
        });
        if ($('#resultList').is(':empty')) {
            $('#resultList').append('<li class="list-group-item">No se encontraron registros</li>');
        }
    }
</script>


@endsection


                    