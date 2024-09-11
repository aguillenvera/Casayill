@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Editar Intercambio</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('index') }}">Site Panel</a></li>
									<li class="breadcrumb-item active" aria-current="page">Create Site</li>
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
										<div class="card-title">Editar el Intercambio</div>
                                        <div class="card-options">
                                        <div class="btn-group ml-5 mb-0">
                                                <a class="btn btn-danger" href="{{route('index')}}">Regresar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('intercambio.update', $intercambio->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="cliente_id">Cliente</label>
                                                    <select name="cliente_id" id="cliente_id" class="form-control">
                                                        @foreach($clientes as $cliente)
                                                            <option value="{{ $cliente->id }}" {{ $cliente->id == $intercambio->cliente_id ? 'selected' : '' }}>
                                                                {{ $cliente->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Productos</label>
                                                    @foreach($productos as $producto)
                                                        <div>
                                                            <input type="checkbox" name="productos[{{ $producto->id }}][id]" value="{{ $producto->id }}"
                                                                {{ $intercambio->productos->contains($producto->id) ? 'checked' : '' }}>
                                                            <label>{{ $producto->producto }} - {{ $producto->marca }} - {{ ucfirst($producto->tipo) }} - {{ $producto->precio }} $</label>
                                                            <input type="number" name="productos[{{ $producto->id }}][cantidad]" 
                                                                value="{{ $intercambio->productos->contains($producto->id) ? $intercambio->productos->find($producto->id)->pivot->cantidad : '' }}"
                                                                placeholder="Cantidad" min="1" class="form-control">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="submit" class="btn btn-primary">Actualizar Intercambio</button>
                                            <a class="btn btn-danger" href="{{ route('intercambio.index') }}">Cancelar</a>
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
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
