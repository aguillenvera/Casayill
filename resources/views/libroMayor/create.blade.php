@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Crear Libro Mayor</h4>
							</div>
                            <div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('libroMayor.index') }}">Site Panel</a></li>
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
										<div class="card-title">Crear Libro Mayor</div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('libroMayor.store') }}"  role="form">
                                            {{ csrf_field() }}
                                            <div class="input-group mb-3">
                                                <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                <input type="number" name="saldo" id="saldo" class="form-control input-sm" placeholder="ingrese Saldo Inicial">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                <input type="text" name="cuenta" id="cuenta" class="form-control input-sm" placeholder="ingrese Nombre de la cuenta">
                                            </div>
                                            <div class="input-group mb-3 w-100">

                                            <span class="card-title"> Seleccione el icono que va a utilizar</span>
         
                                            <select class="select2 icon-select" name="icon" id="divisas" style="width: 100%">
                                                <option value="fa fa-line-chart" selected> Accion</option>
                                                <option value="fa fa-certificate "> Sol</option>
                                                <option value="fa fa-credit-card "> Tarjeta de Credito</option>
                                                <option value="fa fa-money"> Billete</option>
                                                <option value="fa fa-cart-plus "> Carrito</option> 
                                            </select>
                                            <div id="icon-preview-container">
                                                <i id="icon-preview" style="font-size: 40px;" class="fa fa-line-chart"></i> 
                                            </div>

                                            </div>
                                            <div class="input-group mb-3 w-100">

                                                <span class="card-title"> Seleccione el tipo de Cuenta Ingreso/ Egreso</span>

                                                <select class="select2 icon-select" name="tipo" id="tipo" style="width: 100%">
                                                    <option value="fa fa-line-chart" selected> Seleccionar</option>
                                                    <option value="ingreso"> -Ingreso</option>
                                                    <option value="egreso">Egreso</option>

                                                </select>

                                                <p>Ingreso,  aumentan por el debe,  disminuyen por el haber</p>

                                            </div>
                                            <p>Egreso,aumentan por el haber, disminuyen por el debe </p>


                                            <div class="col-xs-12 mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary">Crear</button>
                                                <a href="{{ route('libroMayor.index') }}" class="btn btn-lg btn-danger">Cancelar</a>
                                            </div>
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
    $(document).ready(function () {
        // Evento para detectar cambios en el select
        $('.icon-select').on('change', function () {
            // Obtén el valor seleccionado
            var selectedValue = $(this).val();
            
            // Actualiza la clase del icono de previsualización
            $('#icon-preview').removeClass().addClass(selectedValue);

            // También podrías cambiar el texto de previsualización si es necesario
            // $('#icon-preview-container').html('<i id="icon-preview" class="' + selectedValue + '"></i> Nuevo Texto');
        });
    });
</script>

<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
