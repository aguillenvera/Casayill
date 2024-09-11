@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Promociones</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
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
                        <div class="container mt-5 card p-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('oferta.send') }}" method="post">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="oferta" class="form-label">Oferta</label>
                        <input type="text" class="form-control" name="oferta" id="oferta" placeholder="Escriba la oferta que le va a llegar a los clientes por correo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Clientes</label>
                        <input class="form-check-input" type="checkbox" id="selectAllCheckbox" onchange="selectAll()"><!-- Agrega un ID para identificar este checkbox -->

                        <label class="form-check-label" for="selectAllCheckbox">Seleccionar todos</label>

                        @foreach($clientes as $cliente)
                            <div class="form-check">
                                <input class="form-check-input clientesCheck" type="checkbox" name="clientes[]" value="{{ $cliente->id }}" id="cliente_{{ $cliente->id }}">
                                <label class="form-check-label" for="cliente_{{ $cliente->id }}">{{ $cliente->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Oferta</button>
                </form>
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
    function selectAll() {
        let checkboxes = document.querySelectorAll('.clientesCheck'); // Selecciona todos los checkboxes
        let selectAllCheckbox = document.getElementById('selectAllCheckbox'); // Obtiene el checkbox "Seleccionar todos"

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked; // Establece el estado de cada checkbox según el estado del checkbox "Seleccionar todos"
        });
    }
</script>

<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
