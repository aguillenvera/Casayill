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
								<h4 class="page-title">Libro Mayor</h4>
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
                                            <div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-primary" href="{{route('libroMayor.create')}}"><i class="fa fa-plus mr-2"></i>Añadir un  Libro Mayor</a>
											</div>
										<h3 class="card-title"></h3>
										<div class="card-options">

								
										</div>
									</div>
                                    <div class="card-body">
                                    <form id="searchForm" class="mb-3">
                                        <div class="form-group">
                                            <label for="fecha">Buscar por Fecha:</label>
                                            <input type="text" id="fecha" name="fecha" class="form-control">
                                        </div>
                                        <button type="button" onclick="document.getElementById('searchForm').submit()" class="btn btn-primary">Buscar</button>
                                        <button  type="button" onclick="" class="btn btn-danger" >Cancelar</button>
                                    </form>
                                    <div class="row pt-4">
                                        @foreach($libroMayor as $libro)
                                        <div class="col-xl-4 col-lg-5 col-md-8 col-sm-10 col-12">
                                            <div class="card ">
                                                <div class="row p-4">
                                                    <div class="col-5 mx-2 feature text-center">
                                                        <a href="#">
                                                            <i class="{{$libro->icon}} feature-icon "></i>
                                                        </a>
                                                        <div class="row pt-4">
                                                            <div class="col-6">
                                                                <form action="{{ route('libroMayor.destroy', ['libroMayor' => $libro->id]) }}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-xs" type="submit"><span class="fa fa-trash"></span></button>
                                                                </form>
                                                            </div>
                                                            <div class="col-6">
                                                                <a class="btn btn-primary btn-xs" href="{{ route('libroMayor.edit', ['libroMayor' => $libro->id]) }}" ><span class="fa fa-pencil"></span></a>
                                                            </div>
                                                         
                                                        </div>
                                                    </div>
                                                    <div class="col-5 mx-2">
                                                        <a href="#">
                                                            <h4 class="card-title">{{$libro->cuenta}}</h4>
                                                        </a>
                                                        <span>{{$libro->saldo}} $</span> 
                                                        <p class="fs-13 text-responsive font-weight-bold">ultimo transacción: {{$libro->ultimo_saldo}} </p>
                                                        <a class="btn btn-primary btn-xs mt-3" href="{{ route('showLibroDiario', ['id' => $libro->id]) }}" >Libros Diarios</a>

                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        

                                    </div>
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
        document.getElementById('searchForm').addEventListener('submit', function () {
        });
    });
</script>

<style>
    @media(max-width:576px) {
        .text-responsive {
            font-size: 10px;
        }
    }
</style>

@endsection


                    