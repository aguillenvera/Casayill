@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Crear Diario Diario</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('libroDiario.index') }}">Ver libros Diarios</a></li>
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
										<div class="card-title">Crear Libro diario</div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('libroDiario.store') }}"  role="form">
                                            {{ csrf_field() }}
                                            <div class="input-group mb-5">
                                                <span class="card-title"> Datos de la Transacción:</span>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-addon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                                                <input type="text" name="concepto" id="concepto" class="form-control input-sm" placeholder="concepto">
                                            </div>
                                
                                            <div class="input-group mb-3 w-100">

                                                <!-- Contenedor del primer conjunto de formularios -->
                                                <div id="formContainer1">
                                                <h4>Debe</h4>

                                                    <div class="formTemplate">
                                                        <select class="select2 m-2" name="debeIdMayor[]" style="width: 100%">
                                                            @foreach($libroMayor as $libro)
                                                                <option class="m-2" value="{{$libro->id}}">{{$libro->cuenta}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="number" name="debe[]" class="form-control input-sm m-2" placeholder="monto">
                                                        <button type="button" class="btn btn-lg btn-primary m-2" onclick="removeHaber(this.parentNode.id)">Borrar</button>
                                                    </div>
                                                </div>

                                                <!-- Botón para añadir nuevo formulario al primer conjunto -->
                                                <div>
                                                    <button type="button" class="btn btn-lg btn-primary m-5" onclick="addHaber('formContainer1')">Añadir Cuenta Debe</button>
                                                </div>
                                            </div>

                                            <h4>Haber</h4>
                                            <div class="input-group mb-3 w-100">
                                                <!-- Contenedor del segundo conjunto de formularios -->
                                                <div id="formContainer2">
                                                    <div class="formTemplate">
                                                        <select class="select2 m-2" name="haberIdMayor[]" style="width: 100%">
                                                            @foreach($libroMayor as $libro)
                                                                <option class="m-2" value="{{$libro->id}}">{{$libro->cuenta}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="number" name="haber[]" class="form-control input-sm m-2" placeholder="monto">
                                                        <button type="button" class="btn btn-lg btn-primary m-2" onclick="removeHaber(this.parentNode.id)">Borrar</button>
                                                    </div>
                                                </div>

                                                <!-- Botón para añadir nuevo formulario al segundo conjunto -->
                                                <div>
                                                    <button type="button" class="btn btn-lg btn-primary m-5" onclick="addHaber('formContainer2')">Añadir Cuenta Haber</button>
                                                </div>
                                            </div>

                      

                                            <div class="col-xs-12 mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary" onclick="redirectIndex()">Crear</button>
                                                <a href="{{ route('orden.index') }}" class="btn btn-lg btn-danger">Cancelar</a>
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
    let count = 0;
    function addHaber(containerId) {
        // Clona el formulario
        var container = document.getElementById(containerId);
        var clonedForm = container.querySelector('.formTemplate').cloneNode(true);

        // Cambia el ID para evitar conflictos
        clonedForm.id = 'formInstance' + count++;

        // Inicializa Select2 para el nuevo select
        $(clonedForm).find('.select2').select2();

        // Agrega el formulario clonado al contenedor
        container.appendChild(clonedForm);

        // Muestra el formulario clonado
        clonedForm.style.display = 'block';
    }

    function removeHaber(formId) {
        // Elimina el formulario específico
        var formToRemove = document.getElementById(formId);
        formToRemove.parentNode.removeChild(formToRemove);
    }
</script>

<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
